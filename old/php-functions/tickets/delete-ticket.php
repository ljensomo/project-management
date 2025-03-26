<?php

require '../../Class/Ticket.php';

if(isset($_POST)){
    $ticket = new Ticket;

    if($ticket->remove($_POST['id'])){
        exit(json_encode(['success' => true, 'message' => 'Successfully removed ticket.']));
    }

    exit(json_encode(['success' => false, 'message' => $ticket->getErrorMessage()]));
}

echo json_encode(['status' => false, 'message' => 'Invalid action!']);