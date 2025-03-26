<?php

require '../../Class/ProjectTask.php';

if(isset($_GET['pid'])){
    $task = new ProjectTask();
    $task->setProjectId($_GET['pid']);
    $data = $task->getAllTasks();
    
    echo json_encode(['data' => $data]);
}