<?php

require '../Class/Login.php';

if($_POST){
    $login = new Login($_POST['username'], $_POST['password']);

    if(!$login->isValid()){

        exit(json_encode(['success' => false, 'message' => $login->getErrorMessage()]));
    }

    session_start();

    $_SESSION['user_id'] = $login->getUserid();
    $_SESSION['username'] = $login->getUsername();
    $_SESSION['name'] = $login->getFirstName().' '.$login->getLastName();

    exit(json_encode(['success' => true, 'message' => 'You have successfully logged in.']));

}

echo json_encode(['success' => false, 'message' => 'Invalid action.']);