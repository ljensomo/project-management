<?php

require '../../Class/ProjectModule.php';

if(isset($_POST)){
    $module = new ProjectModule;

    if($module->delete($_POST['id'])){
        exit(json_encode(['success' => true, 'message' => 'Successfully removed module.']));
    }

    exit(json_encode(['success' => false, 'message' => $module->getErrorMessage()]));
}

echo json_encode(['status' => false, 'message' => 'Invalid action!']);