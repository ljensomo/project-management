<?php

require_once 'Database.php';
require_once 'DatabaseQuery.php';

class User extends DatabaseQuery{

    private $userId;
    private $firstName;
    private $lastName;
    private $role;
    private $email;
    private $username;
    private $default_password = "password";

    private $errorMessage;

    public function setUserId($id){
        $this->userId = $id;
    }

    public function setFirstName($firstName){
        $this->firstName = trim($firstName);
    }

    public function setLastName($lastName){
        $this->lastName = trim($lastName);
    }

    public function setRole($role){
        $this->role = $role;
    }

    public function setEmail($email){
        $this->email = trim($email);
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

    public function add(){

        if($this->isNameActive()){
            $this->setErrorMessage('Name already created and is active.');
            return false;
        }

        $password = password_hash($this->default_password, PASSWORD_BCRYPT);

        $this->setQuery('INSERT INTO users (first_name, last_name, email, role_id, username, password) VALUES (?, ?, ?, ?, ?, ?)');
        $this->setParameters([
            $this->firstName,
            $this->lastName,
            $this->email,
            $this->role,
            $this->username,
            $password
        ]);

        return $this->executeQuery();
    }

    public function modify(){

        $this->setQuery('UPDATE users SET first_name = ?, last_name = ?, email = ?, role_id = ? WHERE id = ?');
        $this->setParameters([
            $this->firstName,
            $this->lastName,
            $this->email,
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