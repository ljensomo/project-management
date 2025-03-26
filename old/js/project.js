$(document).ready(function() {
    let module = createModuleVariables("project");

    // populate status options
    populateSelect([
        {
            url: "php-functions/get-project-statuses.php",
            selectId: "statusSelect",
            value: "id",
            text: "name",
            errorMessage: "Failed to retrieve statuses."
        },
        {
            url: "php-functions/get-project-phases.php",
            selectId: "phaseSelect",
            value: "id",
            text: "phase",
            errorMessage: "Failed to retrieve phases."
        }
    ]);

    instantiateDatatable({
        lengthChange: true,
        tableId: module.table,
        url: module.url+"get-projects.php",
        columns: [
            {"data":"id"},
            {"data":"project_name"},
            // {"data":"objective"},
            {"data":"project_phase"},
            {"data":"project_status"},
            {"data":function(data){
                return generateTableRowButtons({
                    rowId: data.id,
                    rowValue: data.project_name,
                    view: true,
                    viewUrl: "project-details.php?pid="+data.id,
                    delete: true,
                    buttonFor: module.name
                });
            }, "className": "text-center"},
        ]
    });

    // submit form listener
    createFormListener({
        moduleName: module.name,
        createOrUpdate: true,
        idInput: "#projectIdInput",
        formId: module.form,
        callback: function(){
            refreshDatatable(module.table);
            $(module.form)[0].reset();
            $(module.modal).modal("toggle");
        }
    });

    // createEditButtonListener({
    //     class: "btn-project-edit",
    //     url: module.url+"get-project.php",
    //     callback: function(data){
    //         $(module.modal+"Label").html("Edit "+data.project_name);

    //         $("#projectIdInput").remove();
    //         $('<input>').attr({
    //             type: "hidden",
    //             id: "projectIdInput",
    //             name: "project_id",
    //             value: data.id
    //         }).prependTo(module.form);
    //         $("#projectNameInput").val(data.project_name);
    //         $("#projectDescriptionInput").val(data.project_description);
    //         $("#phaseSelect").val(data.phase_id);
    //         $("#statusSelect").val(data.status);

    //         $(module.modal).modal("toggle");
    //     }
    // });

    createDeleteButtonListener({
        moduleName: module.name,
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