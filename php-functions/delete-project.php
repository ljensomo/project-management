<?php

require '../Class/Project.php';

if($_POST){
    $project = new Project;

    $project->setProjectId($_POST['id']);

    if($project->delete()){
        exit(json_encode(['success' => true, 'message' => 'Successfully created project.']));
    }

    exit(json_encode(['success' => false, 'message' => $project->getErrorMessage()]));
}

echo json_encode(['success' => false, 'message' => 'Invalid access!']);