<?php

require_once 'Database.php';
require_once 'DatabaseQuery.php';

class ProjectModule extends DatabaseQuery{

    const table = 'project_modules';

    private $id;
    private $project_id;
    private $module_name;
    private $module_description;
    private $error_message;

    public function __construct(){
        parent::__construct(self::table);
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setProjectId($project_id){
        $this->project_id = $project_id;
    }

    public function setModuleName($module_name){
        $this->module_name = $module_name;
    }

    public function setModuleDescription($description){
        $this->module_description = $description;
    }

    public function getErrorMessage(){
        return $this->error_message;
    }

    public function create(){
        return $this->sqlInsert([
            'project_id' => $this->project_id,
            'module_name' => $this->module_name,
            'module_description' => $this->module_description
        ]);
    }

    public function getAllModules(){
        return $this->selectView('vw_project_modules')->where([
            'column_name' => 'project_id',
            'operator' => '=',
            'value' => $this->project_id
        ])->getAll();
    }

    public function getById($id){
        return $this->sqlFetchById($id);
    }

    public function update(){
        return $this->sqlUpdate([
            'module_name' => $this->module_name,
            'module_description' => $this->module_description,
            'id' => $this->id
        ]);
    }

    public function delete($id){
        return $this->sqlDelete($id);
    }
}