<?php

session_start();

require '../../Class/User.php';

if($_SESSION['user_id']){
    $user = new User;
    $data = $user->getAllUsers();
    
    echo json_encode(['data' => $data]);
}