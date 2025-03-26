<?php

session_start();

require '../Class/Login.php';

if(isset($_POST)){
    $login = new Login($_POST['username'], $_POST['password']);

    if(!$login->isValid()){

        exit(json_encode(['success' => false, 'message' => $login->getErrorMessage()]));
    }

    $_SESSION['user_id'] = $login->getUserid();
    $_SESSION['username'] = $login->getUsername();
    $_SESSION['name'] = $login->getFirstName().' '.$login->getLastName();

    exit(json_encode(['success' => true, 'message' => 'You have successfully logged in.']));

}

echo json_encode(['success' => false, 'message' => 'Invalid action.']);