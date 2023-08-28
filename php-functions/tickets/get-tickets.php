<?php

require '../../Class/Ticket.php';

if($_GET){
    $ticket = new Ticket;
    $ticket->setProjectid($_GET['pid']);
    $data = $ticket->getProjectTickets();
    
    echo json_encode(['data' => $data]);
}