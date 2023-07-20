<?php

require '../Class/Project.php';

if($_GET){
    $project = new Project;
    $data = $project->getProject($_GET['id']);
    
    echo json_encode($data);
}

