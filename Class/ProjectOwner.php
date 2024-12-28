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

        return $this->sqlInsert([
            'project_id' => $this->project_id,
            'owner_id' => $this->owner_id
        ]);
    }

    public function getProjectOwners(){

        return $this->selectView('vw_project_owners')->where([
            'column_name' => 'project_id',
            'operator' => '=',
            'value' => $this->project_id
        ])->getAll();
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