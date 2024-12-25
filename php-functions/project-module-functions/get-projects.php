<?php

require '../../Class/Project.php';

$project = new Project;
$data = $project->getAllProjects();

echo json_encode(['data' => $data]);