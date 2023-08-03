const userTableId = "#userTable";
const userModal = "#userModal";
const userForm = "#userForm";

$(document).ready(function(){

    $(userTableId).DataTable({
        "ajax": {
            "url": "php-functions/get-users.php",
            "dataSrc": "data"
        },
        "columns": [
            {"data":"id"},
            {"data":function(data){
                return data.first_name + ' ' + data.last_name
            }},
            {"data":"username"},
            {"data":"role"},
            {"data":function(data){
                let status = "";
                let status_color = "";

                if(data.is_active == 1){
                    status = "Active";
                    status_color = "success";
                }

                if(data.is_active == 0){
                    status = "De-Activated";
                        status_color = "danger";
                }
                
                let label = '<h5><span class="badge rounded-pill bg-'+status_color+'">'+status+'</span></h5>';
                return label;
            },"className":"text-center"},
            {"data":function(data){
                let buttons = "<button type='button' class='btn btn-sm btn-info'>View More</button>";
                buttons += " <button type='button' class='btn btn-sm btn-warning btnEdit' data-id='"+data.id+"'>Edit</button>";

                if(data.is_active == 1){
                    buttons += " <button type='button' class='btn btn-sm btn-danger btnDeActivate' data-id='"+data.id+"' data-value='"+data.username+"'>De-Activate</button>";
                }

                if(data.is_active == 0){
                    buttons += " <button type='button' class='btn btn-sm btn-success btnActivate' data-id='"+data.id+"' data-value='"+data.username+"'>Activate</button>";
                }

                return buttons;
            }, "className": "text-center"},
        ]
    });

    $(userForm).submit(function(e){
        e.preventDefault();

        let action = $("#userIdInput").length ? "update" : "create";

        $.ajax({
            "url":  action === "update" ? "php-functions/update-user.php" : "php-functions/insert-user.php",
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
                    $(userForm)[0].reset();
                    $(userModal).modal("toggle");

                    refreshDatatable(userTableId);
                });
            }else{
                sweetAlert({
                    title: "Ooops!",
                    message: response.message,
                    icon: "error"
                });
            }
        }).fail(function(response){
            sweetAlert({
                title: "Ooops!",
                message: "Failed to "+action+" user.",
                icon: "error"
            });
        });
    });
});

$(document).on("click", ".btnEdit", function(){
    let id = $(this).attr("data-id");

    $("#userCreationNote").hide();

    $.ajax({
        "url": "php-functions/get-user.php",
        "data": {"id":id},
        "method": "GET",
        "dataType":"json"
    }).done(function(data){
        $(userModal+"Label").html("Edit "+data.username);

        $("#userIdInput").remove();
        $('<input>').attr({
            type: "hidden",
            id: "userIdInput",
            name: "userId",
            value: id
        }).prependTo(userForm);

        $("#firstNameInput").val(data.first_name);
        $("#lastNameInput").val(data.last_name);
        $("#roleSelect").val(data.role);

        $(userModal).modal("toggle");
    }).fail(function(response){
        Swal.fire('Ooops!', 'Failed to retrieve user.', 'error');
        console.log(response);
    });
});

$(document).on("click", ".btnDeActivate", function(){
    let id = $(this).attr("data-id");
    let user = $(this).attr("data-value");

    Swal.fire({
        title: "Do you want to de-activate "+user +"?",
        text: user+" will be de-activated and will not be able to access the system.",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Confirm De-activate",
    }).then((result) => {
        if(result.isConfirmed){
            $.ajax({
                "url": "php-functions/deactivate-user.php",
                "method": "POST",
                "data": {"userId":id},
                "dataType": "json"
            }).done(function(response){
                if(response.success){
                    Swal.fire(
                        'De-activated!',
                        response.message,
                        'success'
                    );

                    refreshDatatable(userTableId);
                }else{
                    Swal.fire(
                        'Ooops!',
                        response.message,
                        'error'
                    );
                }
            }).fail(function(response){
                Swal.fire('Ooops!', 'Failed to deactivate '+user+'.', 'error');
                console.log(response);
            });
        }
    });
});

$(document).on("click", ".btnActivate", function(){
    let id = $(this).attr("data-id");
    let user = $(this).attr("data-value");

    Swal.fire({
        title: "Do you want to Activate "+user +"?",
        text: user+" will be activated and will be able to access the system.",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Confirm Activate",
    }).then((result) => {
        if(result.isConfirmed){
            $.ajax({
                "url": "php-functions/activate-user.php",
                "method": "POST",
                "data": {"userId":id},
                "dataType": "json"
            }).done(function(response){
                if(response.success){
                    Swal.fire(
                        'Activated!',
                        response.message,
                        'success'
                    );

                    refreshDatatable(userTableId);
                }else{
                    Swal.fire(
                        'Ooops!',
                        response.message,
                        'error'
                    );
                }
            }).fail(function(response){
                Swal.fire('Ooops!', 'Failed to activate '+user+'.', 'error');
                console.log(response);
            });
        }
    });
});

$(document).on("click", ".btnCreate", function(){
    $(userModal+"Label").html("Create New User");
    $("#userIdInput").remove();
    $(userForm)[0].reset();
    $("#userCreationNote").show();
});
