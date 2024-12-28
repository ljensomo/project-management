<?php

require_once 'DatabaseQuery.php';

class Project extends DatabaseQuery{

    const table = 'projects';

    private $projectId;
    private $projectName;
    private $projectDescription;
    private $status;
    private $createdBy;

    private $errorMessage;

    public function __construct(){
        parent::__construct(self::table);
    }

    public function setProjectId($projectId){
        $this->projectId = $projectId;
    }

    public function setProjectName($projectName){
        $this->projectName = $projectName;
    }

    public function setProjectDescription($projectDescription){
        $this->projectDescription = $projectDescription;
    }

    public function setStatus($status){
        $this->status = $status;
    }

    public function setCreatedBy($created_by){
        $this->createdBy = $created_by;
    }

    public function setErrorMessage($message){
        $this->errorMessage = $message;
    }

    public function getErrorMessage(){
        return $this->errorMessage;
    }

    public function getAllProjects(){
        return $this->selectView('vw_projects')->where([
            'column_name' => 'is_deleted',
            'operator' => '=',
            'value' => 0
        ])->getAll();
    }

    public function getById($id){
        return $this->sqlFetchById($id);
    }

    public function getDetails($id){

        return parent::selectView('vw_project_details')->where([
            'column_name' => 'id',
            'operator' => '=',
            'value' => $id
        ])->get();
    }

    public function create(){
        if(!$this->isProjectNameExist()){
            $this->setErrorMessage('Project name already exist or was already used.');
            return false;
        }

        return $this->sqlInsert(array(
            'project_name' => $this->projectName,
            'project_description' => $this->projectDescription,
            'created_by' => $this->createdBy
        ));
    }

    public function update(){

        if(!$this->isProjectNameExist($this->projectId)){
            $this->setErrorMessage('Project name already exist or was already used.');
            return false;
        }
        
        return $this->sqlUpdate(
            [
                'project_name' => $this->projectName,
                'project_description' => $this->projectDescription,
                'status' => $this->status,
                'id' => $this->projectId
            ]
        );
    }

    public function delete(){
        return $this->sqlSoftDelete($this->projectId);
    }

    public function isProjectNameExist(){

        return $this->sqlSelect()->where([
            'column_name' => 'project_name',
            'operator' => '=',
            'value' => $this->projectName
        ])->where([
            'column_name' => 'id',
            'operator' => '!=',
            'value' => $this->projectId
        ])->get() ? false : true;

    }
}