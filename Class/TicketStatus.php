<?php

require_once 'DatabaseQuery.php';

class TicketStatus extends DatabaseQuery{

    const table = 'ticket_statuses';

    public function __construct(){
        parent::__construct(self::table);
    }

    public function getAllStatus(){
        return $this->sqlFetchAll();
    }

    public function getCategoryStatus($category_id){
        return $this->sqlSelect()->where([
            'column_name' => 'category_id',
            'operator' => '=',
            'value' => $category_id
        ])->getAll();
    }
}