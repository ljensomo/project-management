<?php

require '../../Class/Function.php';

if($_POST){
    $function = new ModuleFunction;

    $function->setModuleId($_POST['moduleId']);
    $function->setName($_POST['functionName']);
    $function->setDescription($_POST['functionDescription']);

    if($function->create()){
        exit(json_encode(['success' => true, 'message' => 'Successfully added function.']));
    }

    exit(json_encode(['success' => false, 'message' => $function->getErrorMessage()]));
}

echo json_encode(['status' => false, 'message' => 'Invalid access!']);