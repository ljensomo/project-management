<?php

require '../../Class/Function.php';

if(isset($_POST)){
    $function = new ModuleFunction;

    if($function->delete($_POST['id'])){
        exit(json_encode(['success' => true, 'message' => 'Successfully removed function.']));
    }

    exit(json_encode(['success' => false, 'message' => $function->getErrorMessage()]));
}

echo json_encode(['status' => false, 'message' => 'Invalid action!']);