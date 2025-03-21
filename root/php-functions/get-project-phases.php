<?php

require '../Class/ProjectPhase.php';

if(isset($_GET)){
    $status = new ProjectPhase;
    $data = $status->getAllPhase();
    
    echo json_encode(['data' => $data]);
}