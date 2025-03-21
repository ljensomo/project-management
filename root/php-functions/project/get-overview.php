<?php

require_once '../../Class/ProjectPhase.php';
require_once '../../Class/Project.php';

$phases = new ProjectPhase();
$data = $phases->getAllPhase();

$overview_data = [];

foreach($data as $phase){
    $project = new Project();
    $tasks = $project->getPhaseTask($phase['id']);

    $task_count = count($tasks);
    if($task_count > 0){
        foreach($tasks as $task){
            if($task['status'] == 3){
                $completed += 1;
            }
            $status = $completed == $task_count ? 'Completed' : 'In Progress';
            $overview_data[] = [
                'phase' => $phase['phase'],
                'status' => $status,
                'progress' => $completed / $task_count * 100 . '%'
            ];
        }
    }else{
        $overview_data[] = [
            'phase' => $phase['phase'],
            'status' => 'Not Started',
            'progress' => '0%'
        ];
    }
}

echo json_encode(['data' => $overview_data]);