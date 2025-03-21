<?php

if($_POST['create_update_project']){
    require '../../Class/Project.php';
    
    $project = new Project;

    $project->setProjectId($_POST['project_id']);
    $project->setProjectName($_POST['project_name']);
    $project->setProjectDescription($_POST['project_description']);
    $project->setPhase($_POST['phase']);
    $project->setStatus($_POST['status']);

    if($project->update()){
        exit(json_encode(['success' => true, 'message' => 'Successfully updated project.']));
    }

    exit(json_encode(['success' => false, 'message' => $project->getErrorMessage()]));
}

echo json_encode(['status' => false, 'message' => 'Invalid access!']);