<?php

require '../Class/User.php';

if($_GET){
    $project = new User;
    $data = $project->getUser($_GET['id']);
    
    echo json_encode($data);
}