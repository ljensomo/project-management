<?php

require_once 'Database.php';

class Project extends Database{

    private $projectId;
    private $projectName;
    private $projectDescription;

    private $errorMessage;

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
        $stmt = $this->connection->prepare('SELECT * FROM projects WHERE is_deleted = 0');
        $stmt->execute(); 
        $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $projects;
    }

    public function getProject($id){
        $stmt = $this->connection->prepare('SELECT * FROM projects WHERE id = ?');
        $stmt->execute([$id]);
        $project = $stmt->fetch(PDO::FETCH_ASSOC);

        return $project;
    }

    public function create(){
        if(!$this->isProjectNameUnique()){
            $this->setErrorMessage('Project name already exist or was already used.');
            return false;
        }

        $stmt = $this->connection->prepare('INSERT INTO projects (project_name, project_description) VALUES (? ,?)');
        $stmt->execute([
            $this->projectName,
            $this->projectDescription
        ]);

        return true;
    }

    public function update(){

        if(!$this->isProjectNameUnique($this->projectId)){
            $this->setErrorMessage('Project name already exist or was already used.');
            return false;
        }
        
        $stmt = $this->connection->prepare('UPDATE projects SET project_name = ?, project_description = ? WHERE id = ?');
        $stmt->execute([$this->projectName, $this->projectDescription, $this->projectId]);

        return true;
    }

    public function delete(){
        $stmt = $this->connection->prepare('UPDATE projects SET is_deleted = 1 WHERE id = ?');
        $stmt->execute([$this->projectId]);

        return true;
    }

    public function isProjectNameUnique($id = 0){

        $query = 'SELECT id FROM projects WHERE project_name = ?';
        $parameters = array($this->projectName);

        if($id != 0){
            $query .= ' AND id != ?';
            $parameters[] = $id;
        }

        $stmt = $this->connection->prepare($query);
        $stmt->execute($parameters); 
        $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($stmt->rowCount()){
            return false;
        }

        return true;
    }
}