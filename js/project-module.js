const moduleTable = "#modulesTable";
const moduleForm = "#modulesForm";
const moduleModal = "#modulesModal";
const projectModuleUrl = "php-functions/project-modules/";

$(document).ready(function(){

    // add input for project id to owner form
    $('<input>').attr({
        type: "hidden",
        name: "projectId",
        value: project_id
    }).prependTo(moduleForm);

    // instantiate module table
    $(moduleTable).DataTable({
        lengthChange: false,
        ajax: {
            url: "php-functions/get-project-modules.php?id="+project_id,
            dataSrc: "data"
        },
        columns: [
            {data: "id"},
            {data: "module_name"},
            {data: "module_description"},
            {data: function(data){
                let progress = '<div class="progress">';
                progress += '<div class="progress-bar bg-success" role="progressbar"';
                progress += ' style="width: '+data.progress+'%;" aria-valuenow="'+data.progress+'" aria-valuemin="0" aria-valuemax="100">'+data.progress+'%</div>';
                progress += '</div>';
                return progress;
            }},
            {data: function(data){
                return generateTableRowButtons({
                    buttonFor: "module",
                    rowId: data.id,
                    rowValue: data.module_name,
                    view: true,
                    viewUrl: "module-details.php?mid="+data.id+"&pid="+project_id,
                    edit: true,
                    delete: true,
                });
            }, className: "text-center", sorting: false}
        ]
    });

    // add custom button in datatable
    $("#modulesTable_wrapper").prepend("<button type='button' class='btn btn-primary' id='btnModuleAdd' data-bs-toggle='modal' data-bs-target='#modulesModal'>Add Module</button>");

    // submit module form
    $(moduleForm).submit(function(e){
        e.preventDefault();

        let isCreate = $("#moduleIdInput").length ? false : true;

        ajaxPost({
            url: projectModuleUrl + (isCreate ? "add-module.php" : "update-module.php"),
            formData: new FormData(this),
            errorMessage: "Failed to "+(isCreate ? "add" : "update")+" new module.",
            callback: function(response){
                if(response.success){
                    swalSuccess({
                        title: isCreate ? "Added!" : "Updated!",
                        text: response.message,
                        callback: function(){
                            refreshDatatable(moduleTable);
                            $(moduleForm)[0].reset();
                            $(moduleModal).modal("toggle");
                        }
                    });
                    return;
                }

                swalError(response.message);
            }
        });
    });

    // button add module clicked
    $("#btnModuleAdd").click(function(){
        $(moduleModal+"Label").html("Add Module");
        $("#moduleIdInput").remove();
    });
});

$(document).on("click", ".btn-module-edit", function(){
    let id = $(this).attr("data-id");

    ajaxGet({
        url: projectModuleUrl+"get-module.php?id="+id,
        callback: function(data){
            $(moduleModal+"Label").html("Edit "+data.module_name);

            $("#moduleIdInput").remove();
            $('<input>').attr({
                type: "hidden",
                id: "moduleIdInput",
                name: "moduleId",
                value: id
            }).prependTo(moduleForm);

            $(moduleModal).modal("toggle");

            $("#moduleNameInput").val(data.module_name);
            $("#moduleDescriptionInput").val(data.module_description);
        },
        errorMessage: "Failed to retrieve project detail."
    });
});

$(document).on("click", ".btn-module-delete", function(){
    let id = $(this).attr("data-id");
    let module = $(this).attr("data-value");

    deleteRecord({
        title: "Remove?",
        text: "Do you want to remove "+module+"?",
        confirmButtonText: "Cofirm Remove",
        subject: module,
        data: {"id": id},
        url: projectModuleUrl+"delete-module.php",
        errorMessage: "Failed to remove module.",
        callback: function(){
            refreshDatatable(moduleTable);
        }
    })
});