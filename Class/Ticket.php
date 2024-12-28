<?php

require_once 'Database.php';
require_once 'DatabaseQuery.php';

class Ticket extends DatabaseQuery{

    const table = 'tickets';

    private $ticket_id;
    private $project_id;
    private $module_id;
    private $category_id;
    private $subject;
    private $description;
    private $assign_to;
    private $status;
    private $created_by;
    private $error_message;

    public function __construct(){
        parent::__construct(self::table);
    }

    public function setTicketId($ticket_id){
        $this->ticket_id = $ticket_id;
    }

    public function setProjectid($project_id){
        $this->project_id = $project_id;
    }

    public function setModuleId($module_id){
        $this->module_id = $module_id;
    }

    public function setCategory($category){
        $this->category_id = $category;
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

    public function create(){

        return $this->sqlInsert([
            'project_id' => $this->project_id,
            'category_id' => $this->category_id,
            'subject' => $this->subject,
            'description' => $this->description,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'assigned_to' => $this->assign_to
        ]);
    }

    public function getProjectTickets(){
        $query = "SELECT 
                    a.id,subject,a.description, 
                    concat(first_name,' ',last_name) as assigned_to,
                    c.`name` AS status,
                    LPAD(a.id,6,0) AS ticket_number,
                    a.date_created
                FROM tickets a
                LEFT JOIN users b ON a.`assigned_to` = b.`id`
                LEFT JOIN ticket_statuses c ON a.`status`=c.`id`
                WHERE project_id = ?
                ORDER BY a.date_created DESC";

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

        return $this->sqlUpdate([
            'assigned_to' => $this->assign_to,
            'status' => $this->status,
            'id' => $this->ticket_id
        ]);
    }

    public function updateDateCompleted(){

        return $this->sqlUpdate([
            'date_completed' => date('Y-m-d H:i:s'),
            'id' => $this->ticket_id
        ]);
    }

    public function getTicket($ticket_id){
        return $this->selectView('vw_tickets')
            ->where([
                'column_name' => 'id',
                'operator' => '=',
                'value' => $ticket_id
            ])
            ->get();
    }

    public function getAllTickets(){
        return $this->selectView('vw_tickets')
            ->where([
                'column_name' => 'status_id',
                'operator' => '<>',
                'value' => 4
            ])
            ->getAll();
    }
}