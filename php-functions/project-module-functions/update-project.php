<?php

if($_POST){
    require '../Class/Project.php';
    
    $project = new Project;

    $project->setProjectId($_POST['projectId']);
    $project->setProjectName($_POST['projectName']);
    $project->setProjectDescription($_POST['projectDescription']);
    $project->setStatus($_POST['status']);

    if($project->update()){
        exit(json_encode(['success' => true, 'message' => 'Successfully updated project.']));
    }

    exit(json_encode(['success' => false, 'message' => $project->getErrorMessage()]));
}

echo json_encode(['status' => false, 'message' => 'Invalid access!']);