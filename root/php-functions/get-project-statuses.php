<?php

require '../Class/ProjectStatus.php';

if(isset($_GET)){
    $status = new ProjectStatus;
    $data = $status->getAllStatus();
    
    echo json_encode(['data' => $data]);
}