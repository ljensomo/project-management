const project_id = $("#projectIdInput").val();
const ownerTable = "#ownerTable";
const ownerModal = "#ownerModal";
const ownerForm = "#ownerForm";
const projectModal = "#projectModal";
const projectForm = "#projectForm";
// --------- TICKETS
const ticketsTable = "#ticketsTable";
const ticketForm = "#ticketForm";
const ticketUrl = "php-functions/tickets/";
const ticketModal = "#ticketModal";

$(document).ready(function(){

    // add input for project id to owner form
    $('<input>').attr({
        type: "hidden",
        name: "projectId",
        value: project_id
    }).prependTo([ownerForm, ticketForm]);

    // populate select options
    populateSelect({
        url: "php-functions/users/get-active-users.php",
        selectId: ["owners", "assignTo"],
        value: "id",
        text: ["first_name", "last_name"],
        errorMessage: "Failed to retrieve owners."
    });

    // instantiate select2
    $("#owners").css({
        width: "100%",
        height: "40px !important",
    }).select2({
        placeholder: "Select owner",
        selectionCssClass: "select2--large", // For Select2 v4.1
        dropdownCssClass: "select2--large",
        dropdownParent: $(ownerModal),
        allowClear: true,
    });

    $("#assignTo").css({
        width: "100%",
        height: "40px !important",
    }).select2({
        placeholder: "Select User",
        selectionCssClass: "select2--large", // For Select2 v4.1
        dropdownCssClass: "select2--large",
        dropdownParent: $(ticketModal),
        allowClear: true,
    });

    // get project details
    ajaxGet({
        url: "php-functions/get-project.php?id="+project_id,
        callback: function(data){
            $("#projectNameInput").val(data.project_name);
            $("#projectDescriptionInput").val(data.project_description);
            $("#dateCreatedInput").val(data.date_created);
        },
        errorMessage: "Failed to retrieve project detail."
    });

    // trigger submit form after clicking save
    $("#btnSaveProject").on("click", function(){
        
        $(projectForm).submit();
    });

    // submit project form
    $(projectForm).submit(function(e){
        e.preventDefault();

        ajaxPost({
            url: "php-functions/update-project.php",
            formData: new FormData(this),
            errorMessage: "Failed to update project details.",
            callback: function(response){
                if(response.success){
                    swalSuccess({
                        title: "Updated!",
                        text: response.message,
                    });
                }
            }
        });
    });

    // submit owner form
    $(ownerForm).submit(function(e){
        e.preventDefault();

        ajaxPost({
            url: "php-functions/add-project-owner.php",
            formData: new FormData(this),
            errorMessage: "Failed to add owner to the project.",
            callback: function(response){
                if(response.success){
                    swalSuccess({
                        title: "Added!",
                        text: response.message,
                        callback: function(){
                            clearSelect2("owners");
                            refreshDatatable(ownerTable);
                        }
                    });
                    return;
                }

                swalError(response.message);
            }
        });
    })

    // instantiate owners table
    $("#ownerTable").DataTable({
        lengthChange: false,
        pagination: false,
        ajax: {
            url: "php-functions/get-project-owners.php?id="+project_id,
            dataSrc: "data"
        },
        columns: [
            {data: "owner", className: "text-center"},
            {data: function(data){
                return "<button type='button' class='btn btn-sm btn-danger btnRemoveOwner' data-id='"+data.id+"' data-value='"+data.owner+"'><i class='fa fa-times'></i></button>";
            }, className: "text-center", sorting: false},
        ]
    });

    // click of remove button
    $(document).on("click", ".btnRemoveOwner", function(){
        let id = $(this).attr("data-id");
        let owner = $(this).attr("data-value");

        deleteRecord({
            title: "Remove?",
            text: "Do you want to remove "+owner+"?",
            confirmButtonText: "Cofirm Remove",
            subject: owner,
            data: {"id": id},
            url: "php-functions/remove-project-owner.php",
            errorMessage: "Failed to remove project owner.",
            table: ownerTable,
            callback: function(){
                refreshDatatable(ownerTable);
            }
        })
    });

    // -------------- PROJECT TABS --------------
    $(document).on("click", ".project-tab", function(){
        $(".project-tab").each(function(i, obj){
            $(this).removeClass("active").removeAttr("aria-current");
            let tab_name = $(this).html().toLowerCase()+"Tab";

            // hide tabs
            $("#"+tab_name).hide();
        });

        $(this).addClass('active').attr("aria-current", "page");

        let tab_name = $(this).html().toLowerCase()+"Tab";
        // show active tab
        $("#"+tab_name).show();
        
    });

    // -------------- TICKETS MODULE --------------
    // instantiate datetable
    $(ticketsTable).DataTable({
        lengthChange: false,
        pagination: false,
        autoWidth: false,
        ajax: {
            url: ticketUrl+"get-tickets.php?pid="+project_id,
            dataSrc: "data"
        },
        columns: [
            {data:"id"},
            {data:"subject"},
            {data:"description"},
            {data:"assigned_to"},
            {data:"status"},
            {data:function(data){
                return generateTableRowButtons({
                    buttonFor: "ticket",
                    rowId: data.id,
                    rowValue: data.id,
                    view: true,
                    viewUrl: "ticket-details.php?tid="+data.id+"&pid="+project_id,
                    edit: true,
                    delete: true
                });
            }, className: "text-center"}
        ]
    });

    // populate select options (categories)
    populateSelect({
        url: "php-functions/category/get-categories.php",
        selectId: "ticketCategory",
        value: "id",
        text: "name",
        errorMessage: "Failed to retrieve categories."
    });

    // add custom button in datatable
    $("#ticketsTable_wrapper").prepend("<button type='button' class='btn btn-primary' id='btnTicketAdd' data-bs-toggle='modal' data-bs-target='#ticketModal'>Add Ticket</button>");

    // click add ticket button
    $("#btnTicketAdd").click(function(){
        $(ticketForm)[0].reset();
        clearSelect2("assignTo");
        $("#ticketStatus").val(1).attr("disabled", true);
        
    });
    
    // submit ticket form
    $(ticketForm).submit(function(e){
        e.preventDefault();

        let isCreate = $("#ticketIdInput").length ? false : true;

        ajaxPost({
            url: ticketUrl + (isCreate ? "add-ticket.php" : "update-ticket.php"),
            formData: new FormData(this),
            errorMessage: "Failed to "+(isCreate ? "add" : "update")+" new ticket.",
            callback: function(response){
                if(response.success){
                    swalSuccess({
                        title: isCreate ? "Created!" : "Updated!",
                        text: response.message,
                        callback: function(){
                            refreshDatatable(ticketsTable);
                            $(ticketForm)[0].reset();
                            $(ticketModal).modal("toggle");
                        }
                    });
                    return;
                }

                swalError(response.message);
            }
        });
    });

    // click delete ticket button
    $(document).on("click", ".btn-ticket-delete", function(){
        let id = $(this).attr("data-id");
    
        deleteRecord({
            title: "Remove?",
            text: "Do you want to delete "+id+"?",
            confirmButtonText: "Cofirm Delete",
            subject: id,
            data: {"id": id},
            url: ticketUrl+"delete-ticket.php",
            errorMessage: "Failed to delete ticket.",
            callback: function(){
                refreshDatatable(ticketsTable);
            }
        })
    });

    // click edit ticket button
    $(document).on("click", ".btn-ticket-edit", function(){
        let id = $(this).attr("data-id");
    
        ajaxGet({
            url: ticketUrl+"get-ticket.php?id="+id,
            callback: function(data){
                $(ticketModal+"Label").html("Edit "+data.id);
    
                $("#ticketIdInput").remove();
                $('<input>').attr({
                    type: "hidden",
                    id: "ticketIdInput",
                    name: "ticketId",
                    value: id
                }).prependTo(ticketForm);
    
                $(ticketModal).modal("toggle");

                $("#ticketStatus").attr("disabled", false);
    
                $("#ticketSubjectInput").val(data.subject);
                $("#ticketDescriptionInput").val(data.description);
                $("#ticketStatus").val(data.status);
                $("#assignTo").val(data.assigned_to);
            },
            errorMessage: "Failed to retrieve ticket detail."
        });
    });
});