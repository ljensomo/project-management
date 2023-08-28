<?php

session_start();

require '../../Class/Ticket.php';

if($_POST){
    $ticket = new Ticket;

    $ticket->setProjectId($_POST['projectId']);
    $ticket->setSubject($_POST['subject']);
    $ticket->setDescription($_POST['description']);
    $ticket->setStatus(1);
    $ticket->setCreatedby($_SESSION['user_id']);

    if($ticket->add()){
        exit(json_encode(['success' => true, 'message' => 'Successfully created ticket.']));
    }

    exit(json_encode(['success' => false, 'message' => $ticket->getErrorMessage()]));
}

echo json_encode(['status' => false, 'message' => 'Invalid access!']);