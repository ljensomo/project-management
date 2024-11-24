<?php

require '../../Class/ProjectTechnology.php';

if($_POST){
    $tech = new ProjectTechnology;

    $tech->setId($_POST['techId']);
    $tech->setName($_POST['technology']);
    $tech->setDescription($_POST['description']);
    $tech->setVersion($_POST['version']);

    if($tech->update()){
        exit(json_encode(['success' => true, 'message' => 'Successfully updated technology.']));
    }

    exit(json_encode(['success' => false, 'message' => $tech->getErrorMessage()]));
}

echo json_encode(['status' => false, 'message' => 'Invalid access!']);