<?php

require '../../Class/User.php';

$user = new User;
$data = $user->getUsers(['is_active' => 1]);

echo json_encode(['data' => $data]);