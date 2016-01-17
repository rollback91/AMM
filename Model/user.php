<?php
class User {
    
    private $user;
    private $password;
            
    function __construct($user, $password) {
        $this->user = $user;
        $this->password = $password;
    }
    public function getUser(){
        return $this->user;
    }
    public function setUser($user){
        $this->user = $user; 
    }
    public function getPass(){
        return $this->password;
    }
    public function setPass($password){
        $this->password = $password; 
    }
    
    public static function save(){}
    public function login(){
        Connector::initialize();
        return Connector::query("SELECT * FROM users", array());
    }
    public static function logout(){}
    

}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

