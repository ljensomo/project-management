<?php

require '../../Class/User.php';

if($_POST){
    $user = new User;

    $user->setFirstName($_POST['firstName']);
    $user->setLastName($_POST['lastName']);
    $user->setRole($_POST['role']);
    $user->setEmail($_POST['email']);
    $user->setUsername();

    if($user->add()){
        exit(json_encode(['success' => true, 'message' => 'Successfully created user.']));
    }

    exit(json_encode(['success' => false, 'message' => $user->getErrorMessage()]));
}

echo json_encode(['status' => false, 'message' => 'Invalid access!']);