<?php

require_once 'DatabaseQuery.php';

class ProjectPhase extends DatabaseQuery{

    const table = 'project_phases';

    public function __construct(){
        parent::__construct(self::table);
    }

    public function getAllPhase(){
        return $this->sqlFetchAll();
    }
}