<?php

require '../Class/User.php';

if($_POST){
    $user = new User;

    $user->setUserId($_POST['userId']);

    if($user->activate()){
        exit(json_encode(['success' => true, 'message' => 'Successfully activated user.']));
    }

    exit(json_encode(['success' => false, 'message' => $user->getErrorMessage()]));
}

echo json_encode(['status' => false, 'message' => 'Invalid access!']);