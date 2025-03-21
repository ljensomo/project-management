<?php

require '../../Class/ProjectTechnology.php';

if(isset($_POST)){
    $tech = new ProjectTechnology;

    if($tech->delete($_POST['id'])){
        exit(json_encode(['success' => true, 'message' => 'Successfully removed technology.']));
    }

    exit(json_encode(['success' => false, 'message' => $tech->getErrorMessage()]));
}

echo json_encode(['status' => false, 'message' => 'Invalid action!']);