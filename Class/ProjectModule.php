<?php

require_once 'Database.php';
require_once 'DatabaseQuery.php';

class ProjectModule extends DatabaseQuery{

    private $id;
    private $project_id;
    private $module_name;
    private $module_description;
    private $error_message;

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

    public function add(){

        $this->setQuery('INSERT INTO project_modules (project_id, module_name, module_description) VALUES (?, ?, ?)');
        $this->setParameters([$this->project_id, $this->module_name, $this->module_description]);
        return $this->executeQuery();
    }

    public function get(){
        $this->setQuery('SELECT * FROM project_modules WHERE project_id = ?');
        $this->setParameters([$this->project_id]);
        return $this->getAll();
    }

    public function remove($id){
        $this->setQuery('DELETE FROM project_modules WHERE id = ?');
        $this->setParameters([$id]);
        return $this->executeQuery();
    }
}