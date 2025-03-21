<?php

session_start();

require '../Class/DatabaseBackup.php';

if(isset($_POST)){
    $db = new DatabaseBackup;
    $db->setCreatedBy($_SESSION['user_id']);

    if($db->doBackup()){
        exit(json_encode(['success'=> true, 'message' => 'Successfully generated backup.']));
    }

    exit(json_encode(['success' => false, 'message' => 'Someething went wrong.']));
}

exit(json_encode(['success' => false, 'message' => 'Invalid access.']));