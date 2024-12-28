<?php

require '../Class/TicketStatus.php';

if(isset($_GET)){
    $status = new TicketStatus;
    $data = $status->getAllStatus();
    
    echo json_encode(['data' => $data]);
}