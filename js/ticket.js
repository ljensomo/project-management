$(document).ready(function(){
    let module = createModuleVariables("ticket");
    let project_url = "php-functions/project-module-functions/";
    let category_url = "php-functions/category-module-functions/";

    function clearForm(){
        $(module.form)[0].reset();
        $("#ticketIdInput").val("");
        $("#categorySelect").attr("disabled", false);
        $("#projectSelect").attr("disabled", false);
        $("#ticketSubjectInput").attr("disabled", false);
        $("#ticketDescriptionInput").attr("disabled", false);
        $("#formActionInput").val(1);
    }

    $(document).on("click", ".btn-create-ticket", function(){
        clearForm();
        $(module.modal+"Label").html("Create Ticket");
        $("#statusDiv").hide();
    });

    // instantiate module table
    instantiateDatatable({
        lengthChange: true,
        tableId: module.table,
        url: module.url+"get-all-tickets.php",
        columns: [
            {data: "id"},
            {data: "category"},
            {data: "project_name"},
            {data: "subject"},
            {data: "date_created"},
            {data: "created_by"},
            {data: "status_name"},
            {data: function(data){
                return generateTableRowButtons({
                    rowId: data.id,
                    rowValue: data.subject,
                    view: true,
                    viewUrl: "ticket-detail.php?id="+data.id,
                    edit: true,
                    buttonFor: module.name,
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
        },
        {
            url: "php-functions/get-ticket-statuses.php",
            selectId: "statusSelect",
            value: "id",
            text: "name",
            errorMessage: "Failed to retrieve statuses."
        }
    ]);

    createFormListener({
        moduleName: module.name,
        createOrUpdate: true,
        idInput: "#ticketIdInput",
        formId: module.form,
        callback: function(){
            refreshDatatable(module.table);
            $(module.form)[0].reset();
            $(module.modal).modal("toggle");
        }
    });

    createEditButtonListener({
        class: "btn-ticket-edit",
        url: module.url+"get-ticket.php",
        errorMessage: "Failed to get ticket.",
        callback: function(data){
            $(module.modal+"Label").html("Edit "+data.id);
            $(module.modal).modal("toggle");

            $("#ticketIdInput").val(data.id);
            $("#categorySelect").val(data.category_id).attr("disabled", true);
            $("#projectSelect").val(data.project_id).attr("disabled", true);
            $("#ticketSubjectInput").val(data.subject).attr("disabled", true);
            $("#ticketDescriptionInput").val(data.description).attr("disabled", true);
            $("#statusSelect").val(data.status_id);
            $("#statusDiv").show();
        }
    });
});