<?php

require '../../Class/ProjectModule.php';

if($_POST){
    $module = new ProjectModule;

    $module->setId($_POST['moduleId']);
    $module->setModuleName($_POST['moduleName']);
    $module->setModuleDescription($_POST['moduleDescription']);

    if($module->update()){
        exit(json_encode(['success' => true, 'message' => 'Successfully updated module.']));
    }

    exit(json_encode(['success' => false, 'message' => $module->getErrorMessage()]));
}

echo json_encode(['status' => false, 'message' => 'Invalid access!']);