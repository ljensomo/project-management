<?php

session_start();

require '../Class/Project.php';

if($_POST){
    $project = new Project;

    $project->setProjectName($_POST['projectName']);
    $project->setProjectDescription($_POST['projectDescription']);
    $project->setCreatedBy($_SESSION['user_id']);

    if($project->create()){
        exit(json_encode(['success' => true, 'message' => 'Successfully created project.']));
    }

    exit(json_encode(['success' => false, 'message' => $project->getErrorMessage()]));
}

echo json_encode(['status' => false, 'message' => 'Invalid access!']);