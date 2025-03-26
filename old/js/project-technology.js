const techTable = "#techTable";
const techForm = "#techForm";
const techModal = "#techModal";
const techUrl = "php-functions/project-tech/";

$(document).ready(function(){

    $('<input>').attr({
        type: "hidden",
        name: "projectId",
        value: project_id
    }).prependTo(techForm);

    // instantiate module table
    $(techTable).DataTable({
        lengthChange: false,
        ajax: {
            url: techUrl + "get-techs.php?pid="+project_id,
            dataSrc: "data"
        },
        columns: [
            {data: "id", visible: false},
            {data: "tech_name"},
            {data: "tech_description"},
            {data: "tech_version"},
            {data: function(data){
                return generateTableRowButtons({
                    buttonFor: "tech",
                    rowId: data.id,
                    rowValue: data.tech_name,
                    edit: true,
                    delete: true,
                });
            }, className: "text-center", sorting: false}
        ]
    });

    $(techTable).css({width:"100%"});

    // add button in datatable
    let add_icon = "<i class='fa fa-plus'></i>";
    let add_button = "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#techModal'>"+add_icon+" Add Technology</button>";
    $("#techTable_wrapper").prepend(add_button);

    // submit module form
    $(techForm).submit(function(e){
        e.preventDefault();

        let isCreate = $("#techIdInput").length ? false : true;

        ajaxPost({
            url: techUrl + (isCreate ? "add-tech.php" : "update-tech.php"),
            formData: new FormData(this),
            errorMessage: "Failed to "+(isCreate ? "add" : "update")+" new techbology.",
            callback: function(response){
                if(response.success){
                    swalSuccess({
                        title: isCreate ? "Added!" : "Updated!",
                        text: response.message,
                        callback: function(){
                            refreshDatatable(techTable);
                            $(techForm)[0].reset();
                            $(techModal).modal("toggle");
                        }
                    });
                    return;
                }
                swalError(response.message);
            }
        });
    });

    $("#btnModuleAdd").click(function(){
        $(techModal+"Label").html("Add Technology");
        $("#techIdInput").remove();
    });

    $(document).on("click", ".btn-tech-edit", function(){
        let id = $(this).attr("data-id");
    
        ajaxGet({
            url: techUrl + "get-tech.php?id="+id,
            callback: function(data){
                $(techModal+"Label").html("Edit "+data.tech_name);
    
                $("#techIdInput").remove();
                $('<input>').attr({
                    type: "hidden",
                    id: "techIdInput",
                    name: "techId",
                    value: id
                }).prependTo(techForm);
    
                $(techModal).modal("toggle");
    
                $("#techNameInput").val(data.tech_name);
                $("#techDescInput").val(data.tech_description);
                $("#techVersionInput").val(data.tech_version);
            },
            errorMessage: "Failed to retrieve technology detail."
        });
    });

    $(document).on("click", ".btn-tech-delete", function(){
        let id = $(this).attr("data-id");
        let tech = $(this).attr("data-value");
    
        deleteRecord({
            title: "Remove?",
            text: "Do you want to remove "+tech+"?",
            confirmButtonText: "Cofirm Remove",
            subject: tech,
            data: {"id": id},
            url: techUrl+"delete-tech.php",
            errorMessage: "Failed to remove technology.",
            callback: function(){
                refreshDatatable(techTable);
            }
        })
    });
});