<?php

session_start();

require '../../Class/Project.php';
require '../../Class/ProjectTask.php';

if($_POST){
    $project = new Project;

    $project->setProjectName($_POST['project_name']);
    $project->setCreatedBy($_SESSION['user_id']);

    if($project->create()){

        exit(json_encode(['success' => true, 'message' => 'Successfully created project.']));
    }

    exit(json_encode(['success' => false, 'message' => $project->getErrorMessage()]));
}

echo json_encode(['status' => false, 'message' => 'Invalid access!']);