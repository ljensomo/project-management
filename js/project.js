$(document).ready(function() {
    let module = createModuleVariables("project");

    // populate status options
    populateSelect([
        {
            url: "php-functions/get-project-status.php",
            selectId: "projectStatus",
            value: "id",
            text: "name",
            errorMessage: "Failed to retrieve status."
        }
    ]);

    instantiateDatatable({
        lengthChange: true,
        tableId: module.table,
        url: module.url+"get-projects.php",
        columns: [
            {"data":"id"},
            {"data":"project_name"},
            {"data":"project_description"},
            {"data":"project_status"},
            {"data":function(data){
                return generateTableRowButtons({
                    rowId: data.id,
                    rowValue: data.project_name,
                    view: true,
                    viewUrl: "project-details.php?pid="+data.id,
                    edit: true,
                    delete: true,
                    buttonFor: module.name
                });
                // let buttons = "<a href='project-details.php?pid="+data.id+"' class='btn btn-sm btn-outline-info'>More</a>";
                // buttons += " <button type='button' class='btn btn-sm btn-outline-warning btnEdit' data-id='"+data.id+"'>Edit</button>";
                // buttons += " <button type='button' class='btn btn-sm btn-outline-danger btnDelete' data-id='"+data.id+"' data-value='"+data.project_name+"'>Delete</button>";
                // return buttons;
            }, "className": "text-center"},
        ]
    });

    // submit form listener
    let action = $("#projectIdInput").length ? "update" : "create";
    createFormListener({
        moduleName: module.name,
        createOrUpdate: true,
        idInput: $("#projectIdInput"),
        formId: module.form,
        url: module.url,
        errorMessage: "Failed to "+action+" project.",
        callback: function(){
            refreshDatatable(module.table);
            $(module.form)[0].reset();
            $(module.modal).modal("toggle");
        }
    });

    createEditButtonListener({
        class: "btn-project-edit",
        url: module.url+"get-project.php",
        callback: function(data){
            $(module.modal+"Label").html("Edit "+data.project_name);

            $("#projectIdInput").remove();
            $('<input>').attr({
                type: "hidden",
                id: "projectIdInput",
                name: "projectId",
                value: data.id
            }).prependTo(module.form);
            $("#projectNameInput").val(data.project_name);
            $("#projectDescriptionInput").val(data.project_description);
            $("#projectStatus").val(data.status);

            $(module.modal).modal("toggle");
        }
    });

    createDeleteButtonListener({
        class: "btn-project-delete",
        url: module.url+"delete-project.php",
        tableId: module.table,
        callback: function(response){
            $(module.modal+"Label").html("Edit "+response.project_name);

            $("#projectIdInput").remove();
            $('<input>').attr({
                type: "hidden",
                id: "projectIdInput",
                name: "projectId",
                value: id
            }).prependTo(module.form);
            $("#projectNameInput").val(response.project_name);
            $("#projectDescriptionInput").val(response.project_description);
            $("#projectStatus").val(response.status);

            $(module.modal).modal("toggle");
        }
    });

    $(document).on("click", ".btnCreate", function(){
        $(module.modal+"Label").html("Create New Project");
        $("#projectIdInput").remove();
        $(module.form)[0].reset();
    });
});

// $(document).on("click", ".btnEdit", function(){
//     let id = $(this).attr("data-id");

//     $.ajax({
//         "url": "php-functions/get-project.php",
//         "data": {"id":id},
//         "method": "GET",
//         "dataType":"json"
//     }).done(function(data){
//         $(projectModal+"Label").html("Edit "+data.project_name);

//         $("#projectIdInput").remove();
//         $('<input>').attr({
//             type: "hidden",
//             id: "projectIdInput",
//             name: "projectId",
//             value: id
//         }).prependTo(projectForm);
//         $("#projectNameInput").val(data.project_name);
//         $("#projectDescriptionInput").val(data.project_description);
//         $("#projectStatus").val(data.status);

//         $(projectModal).modal("toggle");
//     }).fail(function(response){
//         Swal.fire('Ooops!', 'Failed to retrieve project.', 'error');
//         console.log(response);
//     });
// });

// $(document).on("click", ".btnCreate", function(){
//     $(projectModal+"Label").html("Create New Project");
//     $("#projectIdInput").remove();
//     $(projectForm)[0].reset();
// });