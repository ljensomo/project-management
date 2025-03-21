<?php

require '../../Class/Ticket.php';

if($_POST['create_update_ticket']){
    $ticket = new Ticket;

    $ticket->setTicketId($_POST['ticket_id']);
    $ticket->setAssignTo(isset($_POST['assign_to']) ? $_POST['assign_to'] : null);
    $ticket->setStatus($_POST['status']);

    if($ticket->update()){

        if($_POST['status'] == 5){ // if ticket is resolved mark date completed
            $ticket = new Ticket;
            $ticket->setTicketId($_POST['ticket_id']);
            $ticket->updateDateCompleted();
        }

        exit(json_encode(['success' => true, 'message' => 'Successfully updated ticket.']));
    }

    exit(json_encode(['success' => false, 'message' => $ticket->getErrorMessage()]));
}

echo json_encode(['status' => false, 'message' => 'Invalid access!']);