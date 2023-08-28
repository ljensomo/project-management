<?php

require_once 'Database.php';
require_once 'DatabaseQuery.php';

class ModuleFunction extends DatabaseQuery{

    private $module_id;
    private $function_id;
    private $function_name;
    private $function_description;
    private $status;
    private $error_message;

    public function setModuleId($module_id){
        $this->module_id = $module_id;
    }

    public function setId($function_id){
        $this->function_id = $function_id;
    }

    public function setName($function_name){
        $this->function_name = trim($function_name);
    }

    public function setDescription($function_description){
        $this->function_description = trim($function_description);
    }

    public function setStatus($status){
        $this->status = $status;
    }

    public function setErrorMessage($message){
        $this->error_message = $message;
    }

    public function getErrorMessage(){
        return $this->error_message;
    }

    public function add(){
        $this->setQuery('INSERT INTO module_functions (module_id, function_name, function_description, status) VALUES (?, ?, ?, 3)');
        $this->setParameters([
            $this->module_id,
            $this->function_name,
            $this->function_description
        ]);

        return $this->executeQuery();
    }

    public function get(){
        $this->setQuery('SELECT * FROM module_functions WHERE module_id = ?');
        $this->setParameters([$this->module_id]);
        return $this->getAll();
    }

    public function getFunction($id){
        $this->setQuery('SELECT * FROM module_functions WHERE id = ?');
        $this->setParameters([$id]);
        return DatabaseQuery::get();
    }

    public function update(){
        $this->setQuery('UPDATE module_functions SET function_name = ?, function_description = ?, status = ? WHERE id = ?');
        $this->setParameters([
            $this->function_name,
            $this->function_description,
            $this->status,
            $this->function_id
        ]);
        return $this->executeQuery();
    }

    public function remove($id){
        $this->setQuery('DELETE FROM module_functions WHERE id = ?');
        $this->setParameters([$id]);
        return $this->executeQuery();
    }
}