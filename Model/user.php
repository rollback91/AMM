<?php
class User {
    
    private $user;
    private $password;
    private $hash;
            
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
        $a =  "SELECT * FROM users WHERE email = '".$this->user."'";
        echo"\n".$a;
        $res = Connector::query($a);
        if(isset($res)){
            //echo "found";
            foreach($res as $r){
                //echo "found1";
                if(in_array($this->user, $r, false) && in_array($this->password, $r, false)){
//                    echo "found2";
                    $this->hash = mhash(MHASH_MD5, $_SERVER['HTTP_USER_AGENT']. $this->password);
                   // print_r($r);
                    echo Connector::query("UPDATE users SET logged = '".$hash."' WHERE id = ".$r['id']);
//                    echo $hash;

                    return $this->hash;
                }else{
                    echo "User or password not valid";
                }
            }
        }
    }
    public static function logout(){}
    

}
