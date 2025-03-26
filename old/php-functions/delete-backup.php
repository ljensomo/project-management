<?php

require '../Class/DatabaseBackup.php';

if($_POST){
    $database = new DatabaseBackup;

    if($database->delete($_POST['id'])){
        exit(json_encode(['success' => true, 'message' => 'Successfully deleted backup.']));
    }

    exit(json_encode(['success' => false, 'message' => 'Failed to delete backup.']));
}

echo json_encode(['success' => false, 'message' => 'Invalid access!']);