<?php

require '../../Class/User.php';

if($_POST){
    $user = new User;

    $user->setUserId($_POST['userId']);

    if($user->deActivate()){
        exit(json_encode(['success' => true, 'message' => 'Successfully de-activated user.']));
    }

    exit(json_encode(['success' => false, 'message' => $user->getErrorMessage()]));
}

echo json_encode(['status' => false, 'message' => 'Invalid access!']);