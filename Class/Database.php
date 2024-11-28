<?php

class Database{

    private $host;
    private $database_name;
    private $user;
    private $password;
    private $database;

    public $pdo;

    public function __construct(){
        $config = parse_ini_file(dirname(__DIR__)."/config/app.ini");

        $this->setHost($config['host']);
        $this->setDatabase($config['database']);
        $this->setDatabaseName($config['database_name']);
        $this->setUser($config['user']);
        $this->setPassword($config['password']);

        $this->connect();
    }

    public function connect(){
        try{
            $pdo = new PDO("$this->database:host=$this->host;dbname=$this->database_name", $this->user, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->pdo = $pdo;
        }catch(Exception $e){
            throw new Exception("Database connection error: ".$e->getMessage());
        }
    }

    public function setHost($host){
        $this->host = $host;
    }

    public function setDatabase($database){
        $this->database = $database;
    }

    public function setDatabaseName($database_name){
        $this->database_name = $database_name;
    }

    public function setUser($user){
        $this->user = $user;
    }

    public function setPassword($password){
        $this->password = $password;
    }
}