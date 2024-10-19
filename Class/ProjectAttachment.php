<?php

require_once 'Database.php';
require_once 'DatabaseQuery.php';

class ProjectAttachment extends DatabaseQuery{

    const table = 'project_attachments';

    private $id;
    private $project_id;
    private $filename;
    private $real_filename;
    private $added_by;
    private $error_message;

    public function setId($id){
        $this->id = $id;
    }

    public function setProjectId($project_id){
        $this->project_id = $project_id;
    }

    public function setFilename($filename){
        $this->filename = $filename;
    }

    public function setRealFilename($real_filename){
        $this->real_filename = $real_filename;
    }

    public function setAddedBy($added_by){
        $this->added_by = $added_by;
    }

    public function getErrorMessage(){
        return $this->error_message;
    }

    public function create(){

        $query = 'INSERT INTO project_attachments (project_id, filename, real_filename, added_by) VALUES (?, ?, ?, ?)';
        $parameters = [$this->project_id, $this->filename, $this->real_filename, $this->added_by];

        return $this->insert($query, $parameters);
    }

    public function remove($id){
        return DatabaseQuery::delete(self::table, $id);
    }

    public function getByProject($project_id = null){
        $project_id = $project_id == null ? $this->project_id : $project_id;
        $this->setQuery('SELECT * FROM project_attachments WHERE project_id = ?');
        $this->setParameters([$project_id]);
        return $this->getAll();
    }

    public function find($id){
        return DatabaseQuery::getById(self::table, $id);
    }

}