<?php

require_once 'Database.php';

class DatabaseQuery extends Database{

    private $table;
    private $query;
    private $parameters;
    private $stmt;

    private $select_query;
    private $update_query;

    public function __construct($table){

        parent::__construct();

        $this->table = $table;
        $this->select_query = 'SELECT * FROM '.$table;
        $this->update_query = 'UPDATE '.$table.' SET ';
    }

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

    public function fetchAll(){

        $this->executeQuery($this->parameters);
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetch(){
        
        $this->executeQuery();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getRowCount(){

        return $this->stmt->rowCount();
    }

    public function sqlDelete($table, $id){
        $this->setQuery("DELETE FROM $table WHERE id = ?");
        $this->setParameters([$id]);
        return $this->executeQuery();
    }

    public function sqlSoftDelete($id){
        $this->update_query .= 'is_deleted = 1 WHERE id = ?';
        $this->setQuery($this->update_query);
        $this->setParameters(array($id));
        return $this->executeQuery();
    }

    public function sqlInsert($parameters){
        $query = 'INSERT INTO '.$this->table.' ('.implode(',', array_keys($parameters)).') VALUES ';

        // build parameterized columns
        $x = 1;
        $column_count = count($parameters);
        $query_parameterized = [];
        while($x <= $column_count ){
            $query_parameterized[] = "?";
            $x++;
        }

        $query .= ' ('.implode(',', $query_parameterized).') ';

        $this->setQuery($query);
        $this->setParameters(array_values($parameters));
        return $this->executeQuery();
    }

    public function sqlUpdate($parameters){
        // build parameterized columns
        $x = 1;
        $query_parameters = [];
        foreach($parameters as $key => $parameter){
            if ($key != 'id') {
                $this->update_query .= $key . ' = ?';
                $query_parameters[] = $parameter;
            } 
            if ($x < (count($parameters) - 1) ) $this->update_query .= ', ';

            $x++;
        }

        $this->update_query .= ' WHERE id = ?';
        $query_parameters[] = $parameters['id'];

        $this->setQuery($this->update_query);
        $this->setParameters($query_parameters);
        return $this->executeQuery();
    }

    public function sqlFetchById($id){
        $this->setQuery($this->select_query.' WHERE id = ?');
        $this->setParameters(array($id));
        $this->executeQuery();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function sqlFetchAll($condition = null){
        $this->buildSelectWhereClause($condition);
        $this->setQuery($this->select_query);
        $this->executeQuery();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function sqlFetch($condition = null){
        $this->buildSelectWhereClause($condition);
        $this->setQuery($this->select_query);
        $this->executeQuery();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buildSelectWhereClause($conditions){

        $parameters = array();        
        if($conditions != null){
            foreach($conditions as $key => $condition){
                $query_condition = ' ' . strtoupper($key) . ' ' . $condition['column_name'] . ' ' .$condition['operator'] . ' ?';
                $this->select_query .= $query_condition;

                // set parameter value
                $parameters[] = $condition['value'];
            }
            $this->setParameters($parameters);
        }
    }
}