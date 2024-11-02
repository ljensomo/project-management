const loginForm = "#loginForm";

$(document).ready(function(){

    $(loginForm).submit(function(e){
        e.preventDefault();

        ajaxPost({
            url: "php-functions/login.php",
            formData: new FormData(this),
            errorMessage: "Failed to login.",
            callback: function(response){
                if(response.success){
                    window.location.href = "projects.php";
                    return;
                }

                swalError(response.message, "Login Error");
                $("#passwordInput").val('');
            }
        });
    })
});