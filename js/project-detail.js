const ownerTable = "#ownerTable";
const projectModal = "#projectModal";
const projectForm = "#projectForm";

$(document).ready(function(){
    let project_id = $("#projectIdInput").val();

    ajaxGet({
        url: "php-functions/get-project.php?id="+project_id,
        callback: function(data){
            $("#projectNameInput").val(data.project_name);
            $("#projectDescriptionInput").val(data.project_description);
            $("#dateCreatedInput").val(data.date_created);
        },
        errorMessage: "Failed to retrieve project detail."
    });

    $("#btnSave").on("click", function(){
        
        $(projectForm).submit();
    });

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
});