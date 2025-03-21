<?php

require '../../Class/ProjectModule.php';

if($_GET){
    $module = new ProjectModule;

    $module->setProjectId($_GET['pid']);
    $data = $module->getAll();
    
    echo json_encode(['data' => $data]);
}