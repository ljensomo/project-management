<?php

require_once 'Database.php';
require_once 'DatabaseQuery.php';

class User extends DatabaseQuery{

    private $userId;
    private $firstName;
    private $lastName;
    private $role;
    private $username;

    private $errorMessage;

    public function setUserId($id){
        $this->userId = $id;
    }

    public function setFirstName($firstName){
        $this->firstName = $firstName;
    }

    public function setLastName($lastName){
        $this->lastName = $lastName;
    }

    public function setRole($role){
        $this->role = $role;
    }

    public function setUsername(){

        $firstName = explode(' ', $this->firstName);

        foreach($firstName as $name){
            $this->username .= substr($name, 0, 1);
        }

        $this->username .= str_replace( ' ', '', $this->lastName);
        $this->username = strtolower($this->username);

        $name_count = $this->getNameCount();

        $this->username .= $name_count > 0 ? $name_count+1 : '';
    }

    public function setErrorMessage($errorMessage){
        return $this->errorMessage = $errorMessage;
    }

    public function getErrorMessage(){
        return $this->errorMessage;
    }

    public function getUsers($where_clause = null){

        $query = 'SELECT * FROM users';

        if($where_clause != null){
            $x = 0;
            $parameters = [];
            foreach($where_clause as $key => $where){
                if($x === 0){
                    $query .= ' WHERE ';
                }else if($x < 0){
                    $query .= ' AND ';
                }

                $query .= $key.' = ?';

                array_push($parameters, $where);
            }
            $this->setParameters($parameters);
        }

        $this->setQuery($query);

        return $this->getAll();
    }

    public function getUser($id){

        $this->setQuery('SELECT * FROM users WHERE id = ?');
        $this->setParameters([$id]);
        return $this->get();
    }

    public function create(){

        if($this->isNameActive()){
            $this->setErrorMessage('Name already created and is active.');
            return false;
        }

        $this->setQuery('INSERT INTO users (first_name, last_name, role, username) VALUES (?, ?, ?, ?)');
        $this->setParameters([
            $this->firstName,
            $this->lastName,
            $this->role,
            $this->username
        ]);

        return $this->executeQuery();
    }

    public function update(){

        $this->setQuery('UPDATE users SET first_name = ?, last_name = ?, role = ? WHERE id = ?');
        $this->setParameters([
            $this->firstName,
            $this->lastName,
            $this->role,
            $this->userId
        ]);

        return $this->executeQuery();
    }

    public function activate(){
        
        $this->setQuery('UPDATE users SET is_active = 1 WHERE id = ?');
        $this->setParameters([$this->userId]);
        return $this->executeQuery();
    }

    public function deActivate(){

        $this->setQuery('UPDATE users SET is_active = 0 WHERE id = ?');
        $this->setParameters([$this->userId]);
        return $this->executeQuery();
    }

    public function isNameActive(){
        $this->setQuery('SELECT id FROM users WHERE first_name = ? AND last_name = ? AND is_active = 1');
        $this->setParameters([
            $this->firstName,
            $this->lastName
        ]);
        $this->executeQuery();

        return $this->getRowCount() > 0 ? true : false;
    }

    public function getNameCount(){
        $this->setQuery('SELECT id FROM users WHERE first_name = ? AND last_name = ?');
        $this->setParameters([
            $this->firstName,
            $this->lastName
        ]);
        $this->executeQuery();

        return $this->getRowCount();
    }

}