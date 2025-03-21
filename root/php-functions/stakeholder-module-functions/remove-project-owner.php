<?php

require '../../Class/ProjectOwner.php';

if(isset($_POST)){
    $project_owner = new ProjectOwner;

    if($project_owner->remove($_POST['id'])){
        exit(json_encode(['success' => true, 'message' => 'Successfully removed owner.']));
    }

    exit(json_encode(['success' => false, 'message' => $project_owner->getErrorMessage()]));
}

echo json_encode(['status' => false, 'message' => 'Invalid action!']);