const module_id = $("#moduleIdInput").val();
const project_id = $("#projectIdInput").val();
const moduleForm = "#moduleForm";
const functionUrl = "php-functions/module-functions/";
const phpModuleUrl = "php-functions/project-modules/";
const functionsTable = "#functionsTable";
const functionsForm = "#functionsForm";
const functionsModal = "#functionsModal";

$(document).ready(function(){
    
    // get module details
    ajaxGet({
        url: phpModuleUrl+"get-module.php?id="+module_id,
        callback: function(data){
            $("#moduleNameInput").val(data.module_name);
            $("#moduleDescriptionInput").val(data.module_description);
            $("#dateCreatedInput").val(data.date_created);
        },
        errorMessage: "Failed to retrieve module detail."
    });

    // get project details
    ajaxGet({
        url: "php-functions/get-project.php?id="+project_id,
        callback: function(data){
            $("#projectNameInput").val(data.project_name);
        },
        errorMessage: "Failed to retrieve project detail."
    });

    // trigger submit form after click save
    $("#btnSaveModule").on("click", function(){
        $(moduleForm).submit();
    });

    // submit module form
    $(moduleForm).submit(function(e){
        e.preventDefault();

        ajaxPost({
            url: phpModuleUrl+"update-module.php",
            formData: new FormData(this),
            errorMessage: "Failed to update module details.",
            callback: function(response){
                if(response.success){
                    swalSuccess({
                        title: "Updated",
                        text: response.message
                    });
                }
            }
        })
    });

    // ------------------- Functions Tab ------------------------

    // add input for module id to function form
    $('<input>').attr({
        type: "hidden",
        name: "moduleId",
        value: module_id
    }).prependTo(functionsForm);
    
    // instantiate functions table
    $(functionsTable).DataTable({
        lengthChange: false,
        pagination: false,
        ajax: {
            url: functionUrl+"get-functions.php?mid="+module_id,
            dataSrc: "data"
        },
        columns: [
            {data: "id", visible: false},
            {data: "function_name"},
            {data: "function_description"},
            {data: function(data){
                if(data.status == 1){
                    return "Complete";
                }
                if(data.status == 2){
                    return "Ongoing";
                }
                if(data.status == 3){
                    return "Pending";
                }
            }, className: "text-center"},
            {data: function(data){
                return generateTableRowButtons({
                    buttonFor: "function",
                    rowId: data.id,
                    rowValue: data.function_name,
                    edit: true,
                    delete: true
                });
            }, className: "text-center"}
        ]
    });

    // add custom button in datatable
    $(functionsTable+"_wrapper").prepend("<button type='button' class='btn btn-primary' id='btnFunctionAdd' data-bs-toggle='modal' data-bs-target='#functionsModal'>Add Function</button>");

    // button add function clicked
    $("#btnFunctionAdd").click(function(){
        $(functionsModal+"Label").html("Add Function");
        $("#functionIdInput").remove();
        $(functionsForm)[0].reset();
        $("#statusDiv").hide();
        $("#functionStatus").attr("required", false);
    });

    // submit function form
    $(functionsForm).submit(function(e){
        e.preventDefault();

        let isCreate = $("#functionIdInput").length ? false : true;

        ajaxPost({
            url: functionUrl+(isCreate ? "add-function.php" : "update-function.php"),
            formData: new FormData(this),
            errorMessage: "Failed to "+(isCreate ? "add" : "update")+" function.",
            callback: function(response){
                if(response.success){
                    swalSuccess({
                        title: isCreate ? "Added!" : "Updated!",
                        text: response.message,
                        callback: function(){
                            $(functionsForm)[0].reset();
                            $(functionsModal).modal("toggle");
                            refreshDatatable(functionsTable);
                        }
                    });
                    return;
                }

                swalError(response.message);
            }
        })
    });

    // on click of edit button
    $(document).on("click", ".btn-function-edit", function(){
        let id = $(this).attr("data-id");
    
        ajaxGet({
            url: functionUrl+"get-function.php?id="+id,
            callback: function(data){
                $(functionsModal+"Label").html("Edit Function "+data.function_name);
    
                $("#functionIdInput").remove();
                $('<input>').attr({
                    type: "hidden",
                    id: "functionIdInput",
                    name: "functionId",
                    value: id
                }).prependTo(functionsForm);

                $("#statusDiv").show();
                $("#functionStatus").attr("required", true);
    
                $(functionsModal).modal("toggle");
    
                $("#functionNameInput").val(data.function_name);
                $("#functionDescriptionInput").val(data.function_description);
                $("#functionStatus").val(data.status);
            },
            errorMessage: "Failed to retrieve function detail."
        });
    });

    // on click of delete button
    $(document).on("click", ".btn-function-delete", function(){
        let id = $(this).attr("data-id");
        let function_name = $(this).attr("data-value");
    
        deleteRecord({
            title: "Remove?",
            text: "Do you want to remove "+function_name+"?",
            confirmButtonText: "Cofirm Remove",
            subject: function_name,
            data: {"id": id},
            url: functionUrl+"delete-function.php",
            errorMessage: "Failed to remove function.",
            callback: function(){
                refreshDatatable(functionsTable);
            }
        })
    });
    
});