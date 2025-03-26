<?php

require '../../Class/User.php';

if($_POST){
    $user = new User;

    $user->setUserId($_POST['userId']);
    $user->setFirstName($_POST['firstName']);
    $user->setLastName($_POST['lastName']);
    $user->setEmail($_POST['email']);
    $user->setRole($_POST['role']);

    if($user->update()){
        exit(json_encode(['success' => true, 'message' => 'Successfully updated user.']));
    }

    exit(json_encode(['success' => false, 'message' => $user->getErrorMessage()]));
}

echo json_encode(['status' => false, 'message' => 'Invalid access!']);