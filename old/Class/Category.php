<?php

require_once 'Database.php';
require_once 'DatabaseQuery.php';

class Category extends DatabaseQuery{

    const table = 'ticket_categories';

    public function __construct(){
        parent::__construct(self::table);
    }

    public function getAll(){
        $this->setQuery('SELECT * FROM ticket_categories');
        return DatabaseQuery::getAll();
    }
}