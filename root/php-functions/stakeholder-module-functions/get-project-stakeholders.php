<?php

require '../../Class/ProjectStakeholder.php';

if(isset($_GET)){
    $project_owner = new ProjectStakeholder;
    $project_owner->setProjectId($_GET['id']);
    $data = $project_owner->getProjectStakeholders();
    
    echo json_encode(['data' => $data]);
}