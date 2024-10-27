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

    // public function insert($query, $parameters){
    //     $this->setQuery($query);
    //     $this->setParameters($parameters);
    //     return $this->executeQuery();
    // }

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

    public function insert($table, $parameters){
        $query = 'INSERT INTO '.$table.' ('.implode(array_keys($parameters)).') VALUES ';

        // build parameterized columns
        $x = 0;
        $column_count = count($parameters);
        $query_parameterized = [];
        while($x <= $column_count ){
            $query_parameterized[] = "?";
            $x++;
        }

        $query .= ' ('.implode($query_parameterized).') ';

        $this->setQuery($query);
        $this->setParameters(array_values($parameters));
        return $this->executeQuery();
    }

    public function update($table, $parameters){
        $query = 'UPDATE '.$table.' SET ';

        // build parameterized columns
        $x = 0;
        $query_parameters = [];
        foreach($parameters as $key => $parameter){
            $x++;
            $query .= $parameter != 'id' ?: $parameter.' = ?';
            $query .= $x === count($parameters) ?: ',';

            $query_parameters[] = $parameter;
        }

        $query .= ' WHERE id = ?';
        $query_parameters[] = $parameters['id'];

        $this->setQuery($query);
        $this->setParameters($query_parameters);
        return $this->executeQuery();
    }
}