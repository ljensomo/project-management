<?php

require_once 'Database.php';
require_once 'DatabaseQuery.php';

class ProjectTechnology extends DatabaseQuery{

    const table = 'project_tech';

    private $id;
    private $tech_name;
    private $tech_description;
    private $tech_version;
    private $error_message;

    public function setId($id){
        $this->id = $id;
    }

    public function setName($name){
        $this->tech_name = $name;
    }

    public function setDescription($description){
        $this->tech_description = $description;
    }

    public function setVersion($version){
        $this->tech_version = $version;
    }

    public function getErrorMessage(){
        return $this->error_message;
    }

    public function save(){
        if(isset($this->id)){
            return $this->udpate(self::table,[
                'id' => $this->id,
                'tech_name' => $this->tech_name,
                'tech_description' => $this->tech_description,
                'tech_version' => $this->tech_version
            ]);
        }else{
            return $this->insert(self::table,[
                'tech_name' => $this->tech_name,
                'tech_description' => $this->tech_description,
                'tech_version' => $this->tech_version
            ]);
        }
    }

    public function remove($id){
        return $this->delete(self::table, $id);
    }

}