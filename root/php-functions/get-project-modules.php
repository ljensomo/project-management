<?php

require '../Class/ProjectModule.php';

if(isset($_GET)){
    $project_module = new ProjectModule();
    $project_module->setProjectId($_GET['id']);
    $data = $project_module->getAllModules();
    
    echo json_encode(['data' => $data]);
}