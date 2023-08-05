const userTableId = "#userTable";
const userModal = "#userModal";
const userForm = "#userForm";
const phpFunctionUrl = "php-functions/users/";

$(document).ready(function(){

    // instantiate user table
    $(userTableId).DataTable({
        "ajax": {
            "url": phpFunctionUrl+"get-users.php",
            "dataSrc": "data"
        },
        "columns": [
            {data:"id"},
            {data:function(data){
                return data.first_name + ' ' + data.last_name
            }},
            {data: "email"},
            {data:"username"},
            {data:"role"},
            {data: function(data){
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
                
                let label = '<span class="badge rounded-pill bg-'+status_color+'">'+status+'</span>';
                return label;
            }, className:"text-center"},
            {data:function(data){
                let buttons = "<button type='button' class='btn btn-sm btn-info'>View More</button>";
                buttons += " <button type='button' class='btn btn-sm btn-warning btnEdit' data-id='"+data.id+"'>Edit</button>";

                if(data.is_active == 1){
                    buttons += " <button type='button' class='btn btn-sm btn-danger btnDeActivate' data-id='"+data.id+"' data-value='"+data.username+"'>De-Activate</button>";
                }

                if(data.is_active == 0){
                    buttons += " <button type='button' class='btn btn-sm btn-success btnActivate' data-id='"+data.id+"' data-value='"+data.username+"'>Activate</button>";
                }

                return buttons;
            }, className: "text-center", sorting: false},
        ]
    });

    // submit user form
    $(userForm).submit(function(e){
        e.preventDefault();

        let action = $("#userIdInput").length ? "update" : "create";

        ajaxPost({
            url: phpFunctionUrl+ (action === "update" ? "update-user.php" : "add-user.php"),
            formData: new FormData(this),
            errorMessage: "Failed to "+action+" user.",
            callback: function(response){
                if(response.success){
                    swalSuccess({
                        title: action+"d!",
                        text: response.message,
                        callback: function(){
                            refreshDatatable(userTableId);
                            $(userForm)[0].reset();
                            $(userModal).modal("toggle");
                        }
                    });
                    return;
                }

                swalError(response.message);
            }
        });
    });
});

$(document).on("click", ".btnEdit", function(){
    let id = $(this).attr("data-id");

    $("#userCreationNote").hide();

    $.ajax({
        "url": phpFunctionUrl+"get-user.php",
        data: {"id":id},
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
        $("#emailInput").val(data.email);
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
                "url": phpFunctionUrl+"deactivate-user.php",
                "method": "POST",
                data: {"userId":id},
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
                "url": phpFunctionUrl+"activate-user.php",
                "method": "POST",
                data: {"userId":id},
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
