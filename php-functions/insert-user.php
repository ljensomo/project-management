<?php

require '../Class/User.php';

if($_POST){
    $user = new User;

    $user->setFirstName(trim($_POST['firstName']));
    $user->setLastName(trim($_POST['lastName']));
    $user->setRole(trim($_POST['role']));
    $user->setUsername();

    if($user->create()){
        exit(json_encode(['success' => true, 'message' => 'Successfully created user.']));
    }

    exit(json_encode(['success' => false, 'message' => $user->getErrorMessage()]));
}

echo json_encode(['status' => false, 'message' => 'Invalid access!']);