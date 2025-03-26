const ticketUrl = "php-functions/tickets/";
const ticketNoteForm = "#notesForm";

$(document).ready(function(){
    window.ticket_id = $("#ticketIdInput").val();
    window.project_id = $("#projectIdInput").val();

    let module = createModuleVariables('ticket');

    $('<input>').attr({
        type: "hidden",
        name: "ticketId",
        value: ticket_id
    }).prependTo(ticketNoteForm);

    populateSelect([
        {
            selectId: "statusSelect",
            url: "php-functions/get-ticket-statuses.php",
            text: "name",
            value: "id",
            errorMessage: "Failed to retrieve statuses."
        },
        {
            url: "php-functions/category-module-functions/get-categories.php",
            selectId: "categorySelect",
            value: "id",
            text: "name",
            errorMessage: "Failed to retrieve categories."
        },
        {
            url: "php-functions/project-modules/get-modules.php?pid="+project_id,
            selectId: "moduleSelect",
            value: "id",
            text: "module_name",
            errorMessage: "Failed to retrieve modules.",
        },
        {
            url: "php-functions/users/get-active-users.php",
            selectId: "assignedToSelect",
            value: "id",
            text: ["first_name", "last_name"],
            errorMessage: "Failed to retrieve assignees."
        }
    ]);

    // instantiate select2
    $("#moduleSelect, #assignedToSelect").css({
        width: "100%",
        height: "40px !important",
    }).select2({
        placeholder: "Select Module",
        selectionCssClass: "select2--large", // For Select2 v4.1
        dropdownCssClass: "select2--large",
        allowClear: true,
    });

    // get ticket details
    ajaxGet({
        url: module.url+"get-ticket.php?id="+ticket_id,
        callback: function(data){
            $("#categorySelect").val(data.category_id);
            $("#assignedToSelect").val(data.assigned_to).trigger("change");
            $("#projectNameInput").val(data.project_name);
            $("#moduleSelect").val(data.module_id);
            $("#statusSelect").val(data.status_id);
            $("#dateCreatedInput").val(data.date_created);
            $("#dateCompletedInput").val(data.date_completed);
            $("#subjectInput").val(data.subject);
            $("#descriptionInput").val(data.description);
        }
    });

    submitForm({
        
    });

    // // get ticket notes
    // ajaxGet({
    //     url: ticketUrl+"get-notes.php?tid="+ticket_id,
    //     callback: function(data){
    //         let notes = data.data
    //         let notes_element = '';

    //         if(notes.length > 0){
    //             for(var i in notes){
    //                 notes_element += '<div class="alert alert-secondary" role="alert">';
    //                 notes_element += notes[i]['notes'];
    //                 notes_element += "<br><span class='ticket-notes'>"+notes[i]['created_by']+" | "+notes[i]['date_created']+"</span>";
    //                 notes_element += '</div>';
    //             }
    //         }else{
    //             notes_element += '<div class="alert alert-secondary" role="alert">';
    //             notes_element += 'No Ticket notes.';
    //             notes_element += '</div>';
    //         }

    //         $("#notesList").append(notes_element);
    //     }
    // });

    // submit form
    // $(ticketNoteForm).submit(function(e){
    //     e.preventDefault();

    //     ajaxPost({
    //         url: ticketUrl+"add-note.php",
    //         formData: new FormData(this),
    //         errorMessage: "Failed to add note.",
    //         callback: function(response){
    //             if(response.success){
                    
    //                 swalSuccess({
    //                     title: "Added!",
    //                     text: response.messsage,
    //                     callback: function(){
    //                         let notes_element = '<div class="alert alert-secondary" role="alert">';
    //                         notes_element += $("#ticketNotesInput").val();
    //                         notes_element += "<br><span class='ticket-notes'>You | Just now</span>";
    //                         notes_element += '</div>';
    //                         $("#notesList").prepend(notes_element);

    //                         $(ticketNoteForm)[0].reset();
    //                     }
    //                 });
    //                 return;
    //             }

    //             swalError(response.messaage);
    //         }
    //     })
    // });
});