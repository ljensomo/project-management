<?php

require '../../Class/ProjectTechnology.php';

if($_POST){
    $tech = new ProjectTechnology;

    $tech->setProjectId($_POST['projectId']);
    $tech->setName(trim($_POST['technology']));
    $tech->setDescription(trim($_POST['description']));
    $tech->setVersion($_POST['version']);


    if($tech->create()){
        exit(json_encode(['success' => true, 'message' => 'Successfully added technology.']));
    }

    exit(json_encode(['success' => false, 'message' => $tech->getErrorMessage()]));
}

echo json_encode(['status' => false, 'message' => 'Invalid access!']);