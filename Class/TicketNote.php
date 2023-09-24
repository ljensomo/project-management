<?php

require_once 'Database.php';
require_once 'DatabaseQuery.php';

class TicketNote extends DatabaseQuery{

    private $ticket_id;
    private $created_by;
    private $notes;
    private $error_message;

    public function setTicketId($ticket_id){
        $this->ticket_id = $ticket_id;
    }

    public function setCreatedBy($created_by){
        $this->created_by = $created_by;
    }

    public function setNotes($notes){
        $this->notes = trim($notes);
    }

    public function setErrorMessage($message){
        $this->error_message = $message;
    }

    public function getErrorMessage(){
        return $this->error_message;
    }

    public function add(){
        $this->setQuery('INSERT INTO ticket_notes (ticket_id, created_by, notes) VALUES (?, ?, ?)');
        $this->setParameters([
            $this->ticket_id,
            $this->created_by,
            $this->notes
        ]);
        return $this->executeQuery();
    }

    public function getAll(){
        $query = 'SELECT notes,CONCAT(first_name," ",last_name) created_by, a.date_created FROM ticket_notes a
                    JOIN users b ON a.created_by=b.id
                    WHERE ticket_id = ?
                    ORDER BY a.date_created DESC';
        $this->setQuery($query);
        $this->setParameters([$this->ticket_id]);
        return DatabaseQuery::getAll();
    }
}