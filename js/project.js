$(document).ready(function() {

    $("#project-table").DataTable({
        "ajax": {
            "url": "php-functions/get-projects.php",
            "dataSrc": "data"
        },
        "columns": [
            {"data":"id"},
            {"data":"project_name"},
            {"data":"project_description"},
            {"data":function(data){
                let buttons = "<button type='button' class='btn btn-sm btn-info'>View More</button>";
                buttons += " <button type='button' class='btn btn-sm btn-warning'>Edit</button>";
                buttons += " <button type='button' class='btn btn-sm btn-danger'>Delete</button>";
                return buttons;
            }, "className": "text-center"},
        ]
    });
});