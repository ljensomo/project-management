<?php

require_once 'Database.php';
require_once 'DatabaseQuery.php';

class ProjectOwner extends DatabaseQuery{

    const table = 'project_owners';

    private $id;
    private $project_id;
    private $owner_id;
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

    public function getAll(){

        $query = 'SELECT a.id, CONCAT(first_name," ",last_name) AS owner FROM project_owners a JOIN users b ON a.owner_id=b.id WHERE project_id = ?';
        $this->sqlRaw($query, [$this->project_id]);
        return $this->fetchAll();
    }

    public function remove($id){
        return $this->sqlDelete($id);
    }

    public function isOwnerAdded(){

        return $this->sqlSelect()->where([
                'column_name' => 'project_id',
                'operator' => '=',
                'value' => $this->project_id
            ])->where([
                'column_name' => 'owner_id',
                'operator' => '=',
                'value' => $this->owner_id
            ])->getAll();
    }
}