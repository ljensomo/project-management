<?php

require '../../Class/Ticket.php';

if($_GET){
    $ticket = new Ticket;
    $data = $ticket->getTicket($_GET['id']);
    
    echo json_encode($data);
}