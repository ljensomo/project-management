<?php

require '../../Class/User.php';

$user = new User;
$data = $user->getUsers();

echo json_encode(['data' => $data]);