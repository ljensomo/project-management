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
        $query = 'SELECT a.*, FLOOR(IF(complete IS NULL, 0, (complete/(complete+not_complete))*100)) AS progress FROM project_modules a
                    LEFT JOIN (
                    SELECT module_id, 
                        SUM(CASE WHEN STATUS = 1 THEN 1 ELSE 0 END) complete,
                        SUM(CASE WHEN STATUS = 2 OR STATUS = 3 THEN 1 ELSE 0 END) not_complete
                    FROM module_functions GROUP BY module_id
                    ) b ON a.`id` = b.module_id
                    WHERE project_id = ?';
                    
        $this->setQuery($query);
        $this->setParameters([$this->project_id]);
        return DatabaseQuery::getAll();
    }

    public function getAll(){
        $query = 'SELECT * FROM project_modules';

        if($this->project_id != ""){
            $query .= " WHERE project_id = ?";
            $this->setParameters([$this->project_id]);
        }

        $this->setQuery($query);

        return DatabaseQuery::getAll();
    }

    public function getModule($id){
        $this->setQuery('SELECT * FROM project_modules WHERE id = ?');
        $this->setParameters([$id]);
        return DatabaseQuery::get();
    }

    public function update(){
        $this->setQuery('UPDATE project_modules SET module_name = ?, module_description = ? WHERE id = ?');
        $this->setParameters([
            $this->module_name,
            $this->module_description,
            $this->id
        ]);
        return $this->executeQuery();
    }

    public function remove($id){
        $this->setQuery('DELETE FROM project_modules WHERE id = ?');
        $this->setParameters([$id]);
        return $this->executeQuery();
    }
}