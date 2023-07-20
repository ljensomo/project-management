<?php

require '../Class/Project.php';

if($_POST){
    $project = new Project;

    $project->setProjectId($_POST['projectId']);
    $project->setProjectName($_POST['projectName']);
    $project->setProjectDescription($_POST['projectDescription']);

    if($project->update()){
        exit(json_encode(['success' => true, 'message' => 'Successfully updated project.']));
    }

    exit(json_encode(['success' => false, 'message' => $project->getErrorMessage()]));
}

echo json_encode(['status' => false, 'message' => 'Invalid access!']);