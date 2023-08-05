<?php

require_once 'Database.php';
require_once 'DatabaseQuery.php';

class ProjectOwner extends DatabaseQuery{

    private $id;
    private $project_id;
    private $owner_id;
    private $error_message;

    public function setId($id){
        $this->id = $id;
    }

    public function setProjectId($project_id){
        $this->project_id = $project_id;
    }

    public function setOwnerId($owner_id){
        $this->owner_id = $owner_id;
    }

    public function getErrorMessage(){
        return $this->error_message;
    }

    public function add(){

        if($this->isOwnerAdded()){
            $this->error_message = 'User is already added as project owner.';
            return false;
        }

        $this->setQuery('INSERT INTO project_owners (project_id, owner_id) VALUES (?, ?)');
        $this->setParameters([$this->project_id, $this->owner_id]);
        return $this->executeQuery();
    }

    public function get(){
        $this->setQuery('SELECT a.id, CONCAT(first_name," ",last_name) AS owner FROM project_owners a JOIN users b ON a.owner_id=b.id WHERE project_id = ?');
        $this->setParameters([$this->project_id]);
        return $this->getAll();
    }

    public function remove($id){
        $this->setQuery('DELETE FROM project_owners WHERE id = ?');
        $this->setParameters([$id]);
        return $this->executeQuery();
    }

    public function isOwnerAdded(){
        $this->setQuery('SELECT id FROM project_owners WHERE project_id = ? AND owner_id = ?');
        $this->setParameters([$this->project_id, $this->owner_id]);
        $this->executeQuery();
        return $this->getRowCount() ? true : false;
    }
}