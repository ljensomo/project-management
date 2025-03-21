<?php

require '../Class/DatabaseBackup.php';

if(isset($_GET)){
    $database = new DatabaseBackup();
    $data = $database->getAllBackups();
    
    echo json_encode(['data' => $data]);
}