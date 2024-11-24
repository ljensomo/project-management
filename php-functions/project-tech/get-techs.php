<?php

require '../../Class/ProjectTechnology.php';

if($_GET){
    $tech = new ProjectTechnology;

    $tech->setProjectId($_GET['pid']);
    $data = $tech->getAllTechs();
    
    echo json_encode(['data' => $data]);
}