<?php

session_start();

require '../../Class/TicketNote.php';

if($_POST){
    $note = new TicketNote;
    $note->setTicketId($_POST['ticketId']);
    $note->setCreatedBy($_SESSION['user_id']);
    $note->setNotes($_POST['notes']);

    if($note->add()){
        exit(json_encode(['success' => true, 'message' => 'Successfully added note.']));
    }

    exit(json_encode(['success' => false, 'message' => $note->getErrorMessage()]));
}

echo json_encode(['status' => false, 'message' => 'Invalid access!']);