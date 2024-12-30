const project_id = $("#projectIdInput").val();

$(document).ready(function(){
    window.taskModule = createModuleVariables("task");
    window.stakeholder = createModuleVariables("stakeholder");
    window.projectModule = createModuleVariables("project");
    window.ticketModule = createModuleVariables("ticket");

    // get project details
    ajaxGet({
        url: projectModule.url+"get-project.php?id="+project_id,
        callback: function(data){
            $("#projectNameInput").val(data.project_name);
            $("#projectObjectiveInput").val(data.project_description);
            $("#statusSelect").val(data.status);
            $("#createdByInput").val(data.created_by);
            $("#dateCreatedInput").val(data.date_created);
        },
        errorMessage: "Failed to retrieve project detail."
    });

    // add input for project id to owner form
    $('<input>').attr({
        type: "hidden",
        name: "projectId",
        value: project_id
    }).prependTo([stakeholder.form, ticketModule.form]);

    // populate select options
    populateSelect([
        {
            url: "php-functions/users/get-active-users.php",
            selectId: ["ownersSelect", "assignToSelect"],
            value: "id",
            text: ["first_name", "last_name"],
            errorMessage: "Failed to retrieve owners."
        },
        {
            url: "php-functions/get-project-phases.php",
            selectId: "phaseSelect",
            value: "id",
            text: "phase",
            errorMessage: "Failed to retrieve phases."
        },
        {
            url: "php-functions/get-project-statuses.php",
            selectId: ["statusSelect"],
            value: "id",
            text: ["name"],
            errorMessage: "Failed to retrieve status."
        },
        {
            url: "php-functions/category-module-functions/get-categories.php",
            selectId: "categorySelect",
            value: "id",
            text: "name",
            errorMessage: "Failed to retrieve categories."
        }
    ]);

    // instantiate select2
    $("#stakeholderSelect").css({
        width: "100%",
        height: "40px !important",
    }).select2({
        placeholder: "Select User",
        selectionCssClass: "select2--large", // For Select2 v4.1
        dropdownCssClass: "select2--large",
        dropdownParent: $(stakeholder.modal),
        allowClear: true,
    });

    $("#assignToSelect").css({
        width: "100%",
        height: "40px !important",
    }).select2({
        placeholder: "Select User",
        selectionCssClass: "select2--large", // For Select2 v4.1
        dropdownCssClass: "select2--large",
        dropdownParent: $(ticketModule.modal),
        allowClear: true,
    });

    // trigger submit form after clicking save
    $("#btnSaveProject").on("click", function(){
        
        $(projectModule.form).submit();
    });

    createFormListener([
        {
            formId: projectModule.form,
            url: projectModule.url+"update-project.php",
            errorMessage: "Failed to update project details."
        },
        {
            formId: stakeholder.form,
            url: stakeholder.url+"add-project-owner.php",
            errorMessage: "Failed to add owner to the project.",
            callback: function(){
                clearSelect2("ownersSelect");
                refreshDatatable(stakeholder.table);
            }
        },
        {
            formId: ticketModule.form,
            url: ticketModule.url+"add-ticket.php",
            errorMessage: "Failed to add ticket."
        }
    ]);
    
    // instantiate datatables
    instantiateDatatable([
        {
            tableId: stakeholder.table,
            url: stakeholder.url+"get-project-stakeholders.php?id="+project_id,
            columns: [
                {data: "owner", className: "text-center"},
                {data: function(){
                    return "test";
                }},
                {data: function(data){
                    return "<button type='button' class='btn btn-sm btn-danger btn-owner-remove' data-id='"+data.id+"' data-value='"+data.owner+"'><i class='fa fa-times'></i></button>";
                }, className: "text-center", sorting: false}
            ],
            paging: false,
            searching: false,
            info: false
        },
        {
            tableId: taskModule.table,
            url: taskModule.url+"get-project-tasks.php?pid="+project_id,
            searching: true,
            columns: [
                {data: "id"},
                {data: "description"},
                {data: "user_assigned"},
                {data: function(data){
                    let status = "";
                    switch(data.task_status){
                        case "1":
                            status = "Open";
                            break;
                        case "2":
                            status = "In Progress";
                            break;
                        case "3":
                            status = "Completed";
                            break;
                        default:
                            status = "Open";
                            break;
                    }
                    return status;
                }},
                {data: function(data){
                    return generateTableRowButtons({
                        buttonFor: "task",
                        rowId: data.id,
                        rowValue: data.id,
                        edit: true,
                    });
                }, className: "text-center", sorting: false}
            ]
        },
        {
            tableId: ticketModule.table,
            url: ticketModule.url+"get-tickets.php?pid="+project_id,
            columns: [
                {data:"ticket_number"},
                {data:"subject"},
                {data:"description"},
                {data:"date_created"},
                {data:"assigned_to"},
                {data:"status"},
                {data:function(data){
                    return generateTableRowButtons({
                        buttonFor: "ticket",
                        rowId: data.id,
                        rowValue: data.ticket_number,
                        view: true,
                        viewUrl: "ticket-details.php?tid="+data.id+"&pid="+project_id,
                        edit: true,
                        delete: true
                    });
                }, className: "text-center"}
            ],
            columnDefs: [{
                targets: 2,
                render: function ( data, type, row ) {
                    return data.length > 30 ? data.substr( 0, 30 ) + "..." : data;
                }
            }],
            fnRowCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                if(aData["status"] == 'Resolved'){
                   $('td:eq(0), td:eq(1), td:eq(2), td:eq(3), td:eq(4), td:eq(5), td:eq(6)', nRow).addClass('bg-success text-white');
                }
            }
        }
    ]);


    createDeleteButtonListener({
        moduleName: ownerModule.name,
        tableId: ownerModule.table,
        class: "btn-owner-remove",
        url: ownerModule.url+"remove-project-owner.php",
        errorMessage: "Failed to remove project owner."
    });

    // -------------- PROJECT TABS --------------
    $(document).on("click", ".project-tab", function(e){
        e.preventDefault();
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

    // -------------- TICKETS MODULE ------------- 
    // // instantiate datetable
    // $(ticketsTable).DataTable({
    //     aaSorting: [],
    //     lengthChange: false,
    //     pagination: false,
    //     autoWidth: false,
    //     ajax: {
    //         url: ticketUrl+"get-tickets.php?pid="+project_id,
    //         dataSrc: "data"
    //     },
    //     columns: [
    //         {data:"ticket_number"},
    //         {data:"subject"},
    //         {data:"description"},
    //         {data:"date_created"},
    //         {data:"assigned_to"},
    //         {data:"status"},
    //         {data:function(data){
    //             return generateTableRowButtons({
    //                 buttonFor: "ticket",
    //                 rowId: data.id,
    //                 rowValue: data.ticket_number,
    //                 view: true,
    //                 viewUrl: "ticket-details.php?tid="+data.id+"&pid="+project_id,
    //                 edit: true,
    //                 delete: true
    //             });
    //         }, className: "text-center"}
    //     ],
    //     columnDefs: [{
    //         targets: 2,
    //         render: function ( data, type, row ) {
    //             return data.length > 30 ? data.substr( 0, 30 ) + "..." : data;
    //         }
    //     }],
    //     "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
    //         if(aData["status"] == 'Resolved'){
    //            $('td:eq(0), td:eq(1), td:eq(2), td:eq(3), td:eq(4), td:eq(5), td:eq(6)', nRow).addClass('bg-success text-white');
    //         }
    //      },
    // });



    // add custom button in datatable
    let table_buttons = "<button type='button' class='btn btn-primary' id='btnTicketAdd' data-bs-toggle='modal' data-bs-target='#ticketModal'><i class='fa fa-plus'></i> Add Ticket</button>";
    table_buttons += " <button type='button' class='btn btn-success' id='btnDownload'><i class='fa fa-download'></i> Download CSV</button>";
    $("#ticketsTable_wrapper").prepend(table_buttons);

    // click add ticket button
    $("#btnTicketAdd").click(function(){
        $(ticketForm)[0].reset();
        clearSelect2("assignTo");
        $("#ticketStatus").val(1).attr("disabled", true);
        $(ticketModal+"Label").html("New Ticket");
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
                            $("#ticketIdInput").remove();
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
        let value = $(this).attr("data-value");
    
        deleteRecord({
            title: "Remove?",
            text: "Do you want to delete "+value+"?",
            confirmButtonText: "Cofirm Delete",
            subject: value,
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
        let value = $(this).attr("data-value");
    
        ajaxGet({
            url: ticketUrl+"get-ticket.php?id="+id,
            callback: function(data){
                $(ticketModal+"Label").html("Edit "+value);
    
                $("#ticketIdInput").remove();
                $('<input>').attr({
                    type: "hidden",
                    id: "ticketIdInput",
                    name: "ticketId",
                    value: id
                }).prependTo(ticketForm);
    
                $(ticketModal).modal("toggle");

                $("#ticketStatus").attr("disabled", false);
    
                $("#ticketCategory").val(data.category_id)
                $("#ticketSubjectInput").val(data.subject);
                $("#ticketDescriptionInput").val(data.description);
                $("#ticketStatus").val(data.status);
                $("#assignTo").val(data.assigned_to).trigger("change");
            },
            errorMessage: "Failed to retrieve ticket detail."
        });
    });
});