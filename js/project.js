const projectTableId = "#projectTable";
const projectModal = "#projectModal";
const projectForm = "#projectForm";

$(document).ready(function() {

    $(projectTableId).DataTable({
        "ajax": {
            "url": "php-functions/get-projects.php",
            "dataSrc": "data"
        },
        "columns": [
            {"data":"id"},
            {"data":"project_name"},
            {"data":"project_description"},
            {"data":function(data){
                let buttons = "<a href='project-details.php?pid="+data.id+"' class='btn btn-sm btn-outline-info'>More</a>";
                buttons += " <button type='button' class='btn btn-sm btn-outline-warning btnEdit' data-id='"+data.id+"'>Edit</button>";
                buttons += " <button type='button' class='btn btn-sm btn-outline-danger btnDelete' data-id='"+data.id+"' data-value='"+data.project_name+"'>Delete</button>";
                return buttons;
            }, "className": "text-center"},
        ]
    });

    $(projectForm).submit(function(e){
        e.preventDefault();

        let action = $("#projectIdInput").length ? "update" : "create";

        $.ajax({
            "url":  action === "update" ? "php-functions/update-project.php" : "php-functions/insert-project.php",
            "method": "POST",
            "data": new FormData(this),
            "processData": false,
            "contentType": false,
            "cache": false,
            "dataType":"json"
        }).done(function(response){
            if(response.success){
                sweetAlert({
                    title: action === "update" ? "Updated!" : "Created!",
                    message: response.message,
                    icon: "success"
                }, function(){
                    $(projectForm)[0].reset();
                    $(projectModal).modal("toggle");

                    refreshDatatable(projectTableId);
                });
            }else{
                sweetAlert({
                    title: "Ooops!",
                    message: response.message,
                    icon: "error"
                }, function(){
                    $("#projectNameInput").focus();
                });
            }
        }).fail(function(response){
            sweetAlert({
                title: "Ooops!",
                message: "Failed to create project.",
                icon: "error"
            });
        });
    });

});

$(document).on("click", ".btnDelete", function(){
    let id = $(this).attr("data-id");
    let project_name = $(this).attr("data-value");

    Swal.fire({
        title: "Do you want to delete "+project_name +"?",
        text: project_name+" will be deleted from the projects list.",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Confirm Delete",
    }).then((result) => {
        if(result.isConfirmed){
            $.ajax({
                "url": "php-functions/delete-project.php",
                "method": "POST",
                "data": {"id":id},
                "dataType": "json"
            }).done(function(response){
                if(response.success){
                    Swal.fire(
                        'Deleted!',
                        project_name+' has been deleted.',
                        'success'
                    );

                    refreshDatatable(projectTableId);
                }else{
                    Swal.fire(
                        'Ooops!',
                        response.message,
                        'error'
                    );
                }
            }).fail(function(response){
                Swal.fire('Ooops!', 'Failed to delete '+project_name+'.', 'error');
                console.log(response);
            });
        }
    });
});

$(document).on("click", ".btnEdit", function(){
    let id = $(this).attr("data-id");

    $.ajax({
        "url": "php-functions/get-project.php",
        "data": {"id":id},
        "method": "GET",
        "dataType":"json"
    }).done(function(data){
        $(projectModal+"Label").html("Edit "+data.project_name);

        $("#projectIdInput").remove();
        $('<input>').attr({
            type: "hidden",
            id: "projectIdInput",
            name: "projectId",
            value: id
        }).prependTo(projectForm);
        $("#projectNameInput").val(data.project_name);
        $("#projectDescriptionInput").val(data.project_description);

        $(projectModal).modal("toggle");
    }).fail(function(response){
        Swal.fire('Ooops!', 'Failed to retrieve project.', 'error');
        console.log(response);
    });
});

$(document).on("click", ".btnCreate", function(){
    $(projectModal+"Label").html("Create New Project");
    $("#projectIdInput").remove();
    $(projectForm)[0].reset();
});