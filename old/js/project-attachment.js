const attachmentTable = "#attachmentsTable";
const attachmentForm = "#attachmentsForm";
const attachmentModal = "#attachmentsModal";

$(document).ready(function(){

    // add input for project id to owner form
    $('<input>').attr({
        type: "hidden",
        name: "project_id",
        value: project_id
    }).prependTo(attachmentForm);

    // instantiate attachments table
    $(attachmentTable).DataTable({
        width: "100%",
        lengthChange: false,
        ajax: {
            url: "php-functions/project-attachment/get-attachments.php?id="+project_id,
            dataSrc: "data"
        },
        columns: [
            {data: "id"},
            {data: "filename"},
            {data: "added_by"},
            {data: function(data){
                return generateTableRowButtons({
                    buttonFor: "attachment",
                    rowId: data.id,
                    rowValue: data.filename,
                    delete: true,
                });
            }, className: "text-center", sorting: false}
        ]
    });

    $(attachmentTable).css({width:"100%"});

    // add custom button in datatable
    let add_icon = "<i class='fa fa-save'></i>";
    let add_button = "<button type='button' class='btn btn-primary' id='btnAttachmentAdd' data-bs-toggle='modal' data-bs-target='#attachmentsModal'>"+add_icon+" Add Attachment</button>";
    $("#attachmentsTable_wrapper").prepend(add_button);

    // submit attachment form
    $(attachmentForm).submit(function(e){
        e.preventDefault();

        ajaxPost({
            url: "php-functions/project-attachment/add-attachment.php",
            formData: new FormData(this),
            errorMessage: "Failed to add attachment.",
            callback: function(response){
                if(response.success){
                    swalSuccess({
                        title: "Added!",
                        text: response.message,
                        callback: function(){
                            refreshDatatable(attachmentTable);
                            $(attachmentForm)[0].reset();
                            $(attachmentModal).modal("toggle");
                        }
                    });
                    return;
                }

                swalError(response.message);
            }
        });
    });

    $(document).on("click", ".btn-attachment-delete", function(){
        let id = $(this).attr("data-id");
        let filename = $(this).attr("data-value");
    
        deleteRecord({
            title: "Remove?",
            text: "Do you want to remove "+filename+"?",
            confirmButtonText: "Cofirm Remove",
            subject: filename,
            data: {"id": id},
            url: "php-functions/project-attachment/delete-attachment.php",
            errorMessage: "Failed to remove attachment.",
            callback: function(){
                refreshDatatable(attachmentTable);
            }
        })
    });
});