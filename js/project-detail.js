const project_id = $("#projectIdInput").val();
const ownerTable = "#ownerTable";
const ownerModal = "#ownerModal";
const ownerForm = "#ownerForm";
const projectModal = "#projectModal";
const projectForm = "#projectForm";

$(document).ready(function(){

    // add input for project id to owner form
    $('<input>').attr({
        type: "hidden",
        name: "projectId",
        value: project_id
    }).prependTo(ownerForm);

    // populate select options
    populateSelect({
        url: "php-functions/users/get-active-users.php",
        selectId: "owners",
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

});

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