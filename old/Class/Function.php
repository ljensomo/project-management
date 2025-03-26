<?php

require_once 'Database.php';
require_once 'DatabaseQuery.php';

class ModuleFunction extends DatabaseQuery{

    const table = 'module_functions';

    private $module_id;
    private $function_id;
    private $function_name;
    private $function_description;
    private $status;
    private $error_message;

    public function __construct(){
        parent::__construct(self::table);
    }

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

    public function create(){
        return $this->sqlInsert([
            'module_id' => $this->module_id,
            'function_name' => $this->function_name,
            'function_description' => $this->function_description,
            'status' => 3
        ]);
    }

    public function getAllFunctions(){
        return $this->sqlSelect()->where([
            'column_name' => 'module_id',
            'operator' => '=',
            'value' => $this->module_id
        ])->getAll();
    }

    public function getById($id){
        return $this->sqlFetchById($id);
    }

    public function update(){
        return $this->sqlUpdate([
            'function_name' => $this->function_name,
            'function_description' => $this->function_description,
            'status' => $this->status,
            'id' => $this->function_id
        ]);
    }

    public function delete($id){
        return $this->sqlDelete($id);
    }
}