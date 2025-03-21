<?php

require_once 'DatabaseQuery.php';

class ProjectStatus extends DatabaseQuery{

    const table = 'project_statuses';

    public function __construct(){
        parent::__construct(self::table);
    }

    public function getAllStatus(){
        return $this->sqlFetchAll();
    }
}