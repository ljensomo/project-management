$(document).ready(function(){
    let module = createModuleVariables("ticket");
    let project_url = "php-functions/project-module-functions/";
    let category_url = "php-functions/category-module-functions/";

    // instantiate module table
    instantiateDatatable({
        lengthChange: true,
        tableId: module.table,
        url: module.url+"get-all-tickets.php",
        columns: [
            {data: "id"},
            {data: "project_name"},
            {data: "subject"},
            {data: "date_created"},
            {data: "created_by"},
            {data: "status"},
            {data: function(data){
                return generateTableRowButtons({
                    view: true,
                    viewUrl: "ticket-detail.php?id="+data.id,
                    buttonFor: module,
                });
            }, className: "text-center"}
        ]
    });

    // populate select options
    populateSelect([
        {
            selectId: "projectSelect",
            url: project_url+"get-projects.php",
            text: "project_name",
            value: "id"
        },
        {
            selectId: "categorySelect",
            url: category_url+"get-categories.php",
            text: "name",
            value: "id"
        }
    ]);

    createFormListener({
        formId: module.form,
        url: module.url+"create-ticket.php",
        errorMessage: "Failed to create ticket.",
        callback: function(){
            refreshDatatable(module.table);
            $(module.form)[0].reset();
            $(module.modal).modal("toggle");
        }
    });
});