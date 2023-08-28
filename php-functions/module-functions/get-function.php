<?php

require '../../Class/Function.php';

if($_GET){
    $function = new ModuleFunction;
    $data = $function->getFunction($_GET['id']);
    
    echo json_encode($data);
}