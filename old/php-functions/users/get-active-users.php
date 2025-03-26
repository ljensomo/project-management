<?php

require '../../Class/User.php';

$user = new User;
$data = $user->getActiveUsers();

echo json_encode(['data' => $data]);