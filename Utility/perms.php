<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of perms
 *
 * @author amm
 */
class perms {
    //put your code here
    public static function hCheck($hash){
        $query = "SELECT id,logged, password FROM users";
        $res = Connector::query($query);
        
        foreach($res as $r){
            if(in_array($hash, $r, false)){
                $hash1 = hash_hmac('ripemd160', $_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR'], $r['password']);
                if($hash1 === $hash){
                    return $r['id'];
                }
            }
        }
        return false;
    }
}
