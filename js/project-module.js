const moduleTable = "#modulesTable";
const moduleForm = "#modulesForm";
const moduleModal = "#modulesModal";

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
                return generateTableRowButtons({
                    buttonFor: "module",
                    rowId: data.id,
                    rowValue: data.module_name,
                    view: true,
                    viewUrl: "#",
                    edit: true,
                    delete: true,
                });
            }, className: "text-center", sorting: false}
        ]
    });

    // add custom button in datatable
    $("#modulesTable_wrapper").prepend("<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modulesModal'>Add Module</button>");

    // submit module form
    $(moduleForm).submit(function(e){
        e.preventDefault();

        ajaxPost({
            url: "php-functions/add-project-module.php",
            formData: new FormData(this),
            errorMessage: "Failed to add new module.",
            callback: function(response){
                if(response.success){
                    swalSuccess({
                        title: "Added!",
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
    })
});

$(document).on("click", ".btn-module-edit", function(){
    let id = $(this).attr("data-id");
    
})