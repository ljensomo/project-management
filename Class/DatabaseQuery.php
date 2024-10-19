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

    public function insert($query, $parameters){
        $this->setQuery($query);
        $this->setParameters($parameters);
        return $this->executeQuery();
    }

    public function delete($table, $id){
        $this->setQuery("DELETE FROM $table WHERE id = ?");
        $this->setParameters([$id]);
        return $this->executeQuery();
    }

    public function getById($table, $id){
        $this->setQuery("SELECT * FROM $table WHERE id = ?");
        $this->setParameters([$id]);
        return $this->get();
    }
}