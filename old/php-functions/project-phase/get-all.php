<?php

require '../../Class/ProjectPhase.php';

if(isset($_GET)){
    $phases = new ProjectPhase();
    $data = $phases->getAllPhase();
    
    echo json_encode(['data' => $data]);
}