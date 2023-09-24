<?php

require_once 'Database.php';
require_once 'DatabaseQuery.php';

class Category extends DatabaseQuery{

    public function getAll(){
        $this->setQuery('SELECT * FROM ticket_categories');
        return DatabaseQuery::getAll();
    }
}