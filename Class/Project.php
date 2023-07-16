<?php

require_once "Database.php";

class Project extends Database{

    public function getProjects(){
        $stmt = $this->connection->prepare("SELECT * FROM projects");
        $stmt->execute(); 
        $projects = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $projects;
    }
}