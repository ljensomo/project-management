<?php

require '../Class/ProjectModule.php';

if($_POST){
    $project_module = new ProjectModule;

    $project_module->setProjectId($_POST['projectId']);
    $project_module->setModuleName(trim($_POST['moduleName']));
    $project_module->setModuleDescription(trim($_POST['moduleDescription']));


    if($project_module->add()){
        exit(json_encode(['success' => true, 'message' => 'Successfully added module.']));
    }

    exit(json_encode(['success' => false, 'message' => $project_module->getErrorMessage()]));
}

echo json_encode(['status' => false, 'message' => 'Invalid access!']);