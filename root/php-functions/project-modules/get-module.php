<?php

require '../../Class/ProjectModule.php';

if($_GET){
    $module = new ProjectModule;
    $data = $module->getById($_GET['id']);
    
    echo json_encode($data);
}