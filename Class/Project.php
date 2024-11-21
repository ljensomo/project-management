<?php

require_once 'DatabaseQuery.php';

class Project extends DatabaseQuery{

    const table = 'projects';

    private $projectId;
    private $projectName;
    private $projectDescription;

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

    public function setErrorMessage($message){
        $this->errorMessage = $message;
    }

    public function getErrorMessage(){
        return $this->errorMessage;
    }

    public function getProjects(){
        return $this->sqlFetchAll([
            'where' => array(
                'column_name' => 'is_deleted',
                'operator' => '=',
                'value' => 0
                )
            ]
        );
    }

    public function getProject($id){
        return $this->sqlFetchById($id);
    }

    public function create(){
        if(!$this->isProjectNameExist()){
            $this->setErrorMessage('Project name already exist or was already used.');
            return false;
        }

        return $this->sqlInsert(array(
            'project_name' => $this->projectName,
            'project_description' => $this->projectDescription
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
                'id' => $this->projectId
            ]
        );
    }

    public function delete(){
        return $this->sqlSoftDelete($this->projectId);
    }

    public function isProjectNameExist($id = 0){

        $project = $this->sqlFetchAll(
            [
                'where' => [
                    'column_name' => 'project_name',
                    'operator' => '=',
                    'value' => $this->projectName
                ]
            ]
        );

        return count($project) ? false : true;
    }
}