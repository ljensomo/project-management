<?php

require_once 'Database.php';
require_once 'DatabaseQuery.php';

class Login extends DatabaseQuery{

    const table = 'users';

    private $username;
    private $password;
    private $first_name;
    private $last_name;
    private $role;
    private $is_active;
    private $user;
    private $error_message;

    public function __construct($username, $password){
        $this->username = trim($username);
        $this->password = $password;

        parent::__construct(self::table);
    }

    public function isValid(){

        $this->user = $this->sqlFetch([
            'where' => [
                'column_name' => 'username',
                'operator' => '=',
                'value' => $this->username
            ]
        ]);

        if( $this->user === false ){
            $this->error_message = 'You have inputted an invalid username.';
            return false;
        }

        if(!$this->isPasswordCorrect()){
            $this->error_message = 'You have inputted an incorrect password.';
            return false;
        }

        if(!$this->isActive()){
            $this->error_message = 'You no longer have access to the system.';
            return false;
        }

        return true;
    }

    public function isPasswordCorrect(){

        if(!password_verify($this->password, $this->user['password'])){
            return false;
        }

        return true;
    }

    public function isActive(){
        return $this->user['is_active'] ? true : false;
    }

    public function getUserId(){
        return $this->user['id'];
    }

    public function getUsername(){
        return $this->user['username'];
    }

    public function getFirstName(){
        return $this->user['first_name'];
    }

    public function getLastName(){
        return $this->user['last_name'];
    }

    public function getErrorMessage(){
        return $this->error_message;
    }

}