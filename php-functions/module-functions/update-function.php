<?php

require '../../Class/Function.php';

if($_POST){
    $function = new ModuleFunction;

    $function->setId($_POST['functionId']);
    $function->setName($_POST['functionName']);
    $function->setDescription($_POST['functionDescription']);
    $function->setStatus($_POST['status']);

    if($function->update()){
        exit(json_encode(['success' => true, 'message' => 'Successfully updated function.']));
    }

    exit(json_encode(['success' => false, 'message' => $function->getErrorMessage()]));
}

echo json_encode(['status' => false, 'message' => 'Invalid access!']);