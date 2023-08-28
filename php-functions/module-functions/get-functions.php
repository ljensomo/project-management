<?php

require '../../Class/Function.php';

if($_GET){
    $function = new ModuleFunction;
    $function->setModuleId($_GET['mid']);
    $data = $function->get();
    
    echo json_encode(['data' => $data]);
}