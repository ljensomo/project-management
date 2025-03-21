<?php

require '../../Class/ProjectStakeholder.php';

if($_POST['add_project_owner']){
    $project_owner = new ProjectStakeholder;

    $project_owner->setProjectId($_POST['project_id']);
    $project_owner->setStakeholderId($_POST['stakeholder_id']);

    if($project_owner->add()){
        exit(json_encode(['success' => true, 'message' => 'Successfully added as owner.']));
    }

    exit(json_encode(['success' => false, 'message' => $project_owner->getErrorMessage()]));
}

echo json_encode(['status' => false, 'message' => 'Invalid access!']);