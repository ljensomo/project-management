<?php

session_start();

if(isset($_POST['create_ticket'])){
    require_once '../../Class/Ticket.php';
    $ticket = new Ticket();

    $ticket->setProjectid($_POST['project']);
    $ticket->setCategory($_POST['category']);
    $ticket->setSubject($_POST['subject']);
    $ticket->setDescription($_POST['description']);
    $ticket->setStatus(1);
    $ticket->setCreatedby($_SESSION['user_id']);
    $ticket->setAssignTo(0);

    if($ticket->create()){
        exit(json_encode(['success' => true, 'message' => 'Ticket successfully created.']));
    }

    exit(json_encode(['success' => false, 'message' => $ticket->getErrorMessage()]));
}

exit(json_encode(['status' => false, 'message' => 'Invalid form!']));