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
        //echo"</br>".$a;
        $res = Connector::query($a);
        if(isset($res)){
            //echo "</br>found";
            //print_r($res);
            foreach($res as $r){
                //echo "</br>found1";
                if(in_array($this->user, $r, false) && in_array($this->password, $r, false)){
                   // echo "</br>found2";
                    $this->hash = hash_hmac('ripemd160', $_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR'], $this->password);
                    //print_r($r);
                    Connector::query("UPDATE users SET logged = '".$this->hash."' WHERE id = ".$r['id']);
                    //echo $this->hash;

                    return $this->hash;
                }else{
                    echo "User or password not valid";
                }
            }
        }
        return "nothing";
    }
    public static function logout($key){
        $res = Connector::query("UPDATE users SET logged = NULL where logged ='".$key."'");
        //echo var_dump($res);
        return $res === true ? "true" : "false";
    }
    

}
