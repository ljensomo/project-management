<?php

require '../../Class/TicketNote.php';

if($_GET){
    $note = new TicketNote;
    $note->setTicketId($_GET['tid']);
    $data = $note->getAll();
    
    echo json_encode(['data' => $data]);
}