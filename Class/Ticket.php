<?php

require_once 'Database.php';
require_once 'DatabaseQuery.php';

class Ticket extends DatabaseQuery{

    private $ticket_id;
    private $project_id;
    private $module_id;
    private $subject;
    private $description;
    private $assign_to;
    private $status;
    private $created_by;
    private $error_message;

    public function setTicketId($ticket_id){
        $this->ticket_id = $ticket_id;
    }

    public function setProjectid($project_id){
        $this->project_id = $project_id;
    }

    public function setModuleId($module_id){
        $this->module_id = $module_id;
    }

    public function setSubject($subject){
        $this->subject = $subject;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function setAssignTo($assign_to){
        $this->assign_to = $assign_to;
    }

    public function setStatus($status){
        $this->status = $status;
    }

    public function setCreatedby($created_by){
        $this->created_by = $created_by;
    }

    public function setErrorMessagge($message){
        $this->error_message = $message;
    }

    public function getErrorMessage(){
        return $this->error_message;
    }

    public function add(){
        $this->setQuery('INSERT INTO tickets (project_id, subject, description, status, created_by) VALUES (?, ?, ?, ?, ?)');
        $this->setParameters([
            $this->project_id,
            trim($this->subject),
            trim($this->description),
            $this->status,
            $this->created_by
        ]);

        return $this->executeQuery();
    }

    public function getProjectTickets(){
        $query = "SELECT 
                    a.id,subject,a.description, 
                    concat(first_name,' ',last_name) as assigned_to,
                    c.`name` as status
                FROM tickets a
                LEFT JOIN users b ON a.`assigned_to` = b.`id`
                LEFT JOIN ticket_statuses c ON a.`status`=c.`id`
                WHERE project_id = ?";

        $this->setQuery($query);
        $this->setParameters([
            $this->project_id
        ]);

        return $this->getAll();
    }

    public function remove($id){
        $this->setQuery('DELETE FROM tickets WHERE id = ?');
        $this->setParameters([
            $id
        ]);

        return $this->executeQuery();
    }

    public function update(){
        $this->setQuery('UPDATE tickets SET subject = ?, description = ?, assigned_to = ?, status = ? WHERE id = ?');
        $this->setParameters([
            trim($this->subject),
            trim($this->description),
            $this->assign_to,
            $this->status,
            $this->ticket_id
        ]);

        return $this->executeQuery();
    }

    public function getTicket($ticket_id){
        $this->setQuery('SELECT * FROM tickets WHERE id = ?');
        $this->setParameters([$ticket_id]);
        return $this->get();
    }
}