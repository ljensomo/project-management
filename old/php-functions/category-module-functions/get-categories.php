<?php

require '../../Class/Category.php';

$category = new Category;
$data = $category->getAll();

echo json_encode(['data' => $data]);