<?php

require '../Class/TicketStatus.php';

if(isset($_GET['category_id'])){
    $status = new TicketStatus;
    //$data = $status->getAllStatus();
    $data = $status->getCategoryStatus($_GET['category_id']);
    
    echo json_encode(['data' => $data]);
}