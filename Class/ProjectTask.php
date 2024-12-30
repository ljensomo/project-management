<?php

require_once 'DatabaseQuery.php';

class ProjectTask extends DatabaseQuery{

    const table = 'project_tasks';

    private $project_id;
    private $assigned_to;
    private $task_id;

    public function __construct(){
        parent::__construct(self::table);
    }

    public function setProjectId($project_id){
        $this->project_id = $project_id;
    }

    public function setAssignedTo($assigned_to){
        $this->assigned_to = $assigned_to;
    }

    public function setTaskId($task_id){
        $this->task_id = $task_id;
    }

    public function create(){
        return $this->sqlInsert([
            'project_id' => $this->project_id,
            'assigned_to' => $this->assigned_to,
            'task_id' => $this->task_id
        ]);
    }

    public function getAllTasks(){
        if(isset($this->project_id)){
            return $this->selectView('vw_project_tasks')->where([
                'column_name' => 'project_id',
                'operator' => '=',
                'value' => $this->project_id
            ])->getAll();
        }
    }
}