<?php

require '../../Class/ProjectTechnology.php';

if($_GET){
    $tech = new ProjectTechnology;
    $data = $tech->getById($_GET['id']);
    
    echo json_encode($data);
}