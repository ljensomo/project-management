<?php

require '../../Class/Ticket.php';

if($_GET){
    $ticket = new Ticket;
    $data = $ticket->getAllTickets();
    
    echo json_encode(['data' => $data]);
}