<?php

require_once 'Database.php';
require_once 'DatabaseQuery.php';

class ProjectTechnology extends DatabaseQuery{

    const table = 'project_techs';

    private $id;
    private $projectId;
    private $techName;
    private $techDescription;
    private $techVersion;
    private $error_message;

    public function __construct(){
        parent::__construct(self::table);
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setProjectId($project_id){
        $this->projectId = $project_id;
    }

    public function setName($name){
        $this->techName = $name;
    }

    public function setDescription($description){
        $this->techDescription = $description;
    }

    public function setVersion($version){
        $this->techVersion = $version;
    }

    public function getErrorMessage(){
        return $this->error_message;
    }

    public function getAllTechs(){
        return $this->sqlFetchAll();
    }

    public function getById($id){
        return $this->sqlFetchById($id);
    }

    public function create(){
        return $this->sqlInsert([
            'project_id' => $this->projectId,
            'tech_name' => $this->techName,
            'tech_description' => $this->techDescription,
            'tech_version' => $this->techVersion
        ]);
    }

    public function update(){
        return $this->sqlUpdate([
            'id' => $this->id,
            'tech_name' => $this->techName,
            'tech_description' => $this->techDescription,
            'tech_version' => $this->techVersion,

        ]);
    }

    public function delete($id){
        return $this->sqlDelete($id);
    }

}