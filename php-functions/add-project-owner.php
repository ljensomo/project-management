<?php

require '../Class/ProjectOwner.php';

if($_POST){
    $project_owner = new ProjectOwner;

    $project_owner->setProjectId($_POST['projectId']);
    $project_owner->setOwnerId($_POST['owner']);

    if($project_owner->add()){
        exit(json_encode(['success' => true, 'message' => 'Successfully added owner.']));
    }

    exit(json_encode(['success' => false, 'message' => $project_owner->getErrorMessage()]));
}

echo json_encode(['status' => false, 'message' => 'Invalid access!']);