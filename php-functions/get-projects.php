<?php

require '../Class/Project.php';

$project = new Project;
$data = $project->getProjects();

echo json_encode(['data' => $data]);