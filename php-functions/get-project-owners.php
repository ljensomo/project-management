<?php

require '../Class/ProjectOwner.php';

if(isset($_GET)){
    $project_owner = new ProjectOwner;
    $project_owner->setProjectId($_GET['id']);
    $data = $project_owner->get();
    
    echo json_encode(['data' => $data]);
}