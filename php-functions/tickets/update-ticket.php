<?php

require '../../Class/Ticket.php';

if($_POST){
    $ticket = new Ticket;

    $ticket->setTicketId($_POST['ticketId']);
    $ticket->setSubject($_POST['subject']);
    $ticket->setDescription($_POST['description']);
    $ticket->setAssignTo($_POST['assign_to']);
    $ticket->setStatus($_POST['status']);
    $ticket->setCategory(($_POST['category']));

    if($ticket->update()){

        if($_POST['status'] == 5){ // if ticket is resolved mark date completed
            $ticket->updateDateCompleted();
        }

        exit(json_encode(['success' => true, 'message' => 'Successfully updated ticket.']));
    }

    exit(json_encode(['success' => false, 'message' => $ticket->getErrorMessage()]));
}

echo json_encode(['status' => false, 'message' => 'Invalid access!']);