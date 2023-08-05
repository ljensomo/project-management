<?php

require_once 'Database.php';

class DatabaseQuery extends Database{

    private $query;
    private $parameters;
    private $stmt;

    public function setQuery($query){
        $this->query = $query;
    }

    public function setParameters($parameters){
        $this->parameters = $parameters;
    }

    public function executeQuery(){

        $this->stmt = $this->connection->prepare($this->query);
        return $this->stmt->execute($this->parameters);
    }

    public function getAll(){

        $this->executeQuery($this->parameters);
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get(){
        
        $this->executeQuery();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getRowCount(){

        return $this->stmt->rowCount();
    }
}