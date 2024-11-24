<?php

require '../../Class/Function.php';

if($_GET){
    $function = new ModuleFunction;
    $data = $function->getByID($_GET['id']);
    
    echo json_encode($data);
}