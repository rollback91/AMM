<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Connector {

    private static $servername = "localhost";
    private static $username = "root";
    private static $password = "davide";
    private static $dbname = "todo_db";
    private static $conn;
    
    private static function initialize() {
        // Create connectio
        self::$conn = new mysqli(self::$servername, self::$username, self::$password, self::$dbname);

        // Check connection
        if (self::$conn->connect_error) {
            return -1;
        }
        return 0;
    }

    static function queryIO($query, $elements) {
        $check = self::initialize();
        $params = array();
        if ($check >= 0) {
            $stmt = self::$conn->prepare($query);
            
            //$elements is an array of arrays that includes [<type>,<value>]
            foreach($elements as $e){
                $params = & $e;
            }
            call_user_func(array($stmt, "bind_param"), $params);
            $stmt->execute();
            $res = $stmt->get_result();
            while($row = $res->fetch_array(MYSQLI_ASSOC)) {
              array_push($a_data, $row);
            }
            return $a_data;
        }
        self::$conn->close();
        die("Connection Error");
    }
    
    static function query($query){
        $ret = [];
        $check = self::initialize();
        if ($check >= 0) {
            $res = self::$conn->query($query);
            //log($query);
            //echo $res;
            //echo "</br> stringa query";
            //echo self::$conn->affected_rows;
            //echo $res->toString();
           if($res !== true){
                while($row = $res->fetch_array(MYSQLI_ASSOC)) {
                    array_push($ret, $row);
                  //$ret[] = $row;
                }
                //print_r($ret);
                $res->free();
            }else{
                $ret = true;
            }
            
        //echo "test";
        }else{
            $ret = "Connection Error";
        }
        
        self::$conn->close();
        return isset($ret) ? $ret : NULL; 
    }
    
    static function queryTran($query){
        $ret = [];
        $flag = true;
        $check = self::initialize();
        self::$conn->autocommit(false);
        if ($check >= 0) {
            //print_r($query);
            foreach($query as $q){
                //print_r($q);
                $res = self::$conn->query($q);
                //echo self::$conn->error;
                if(self::$conn->error){
                    $flag = false;
                    //echo "ERRORE".$q;
                    array_push($ret,"Errore query: ".$q);
                }
            }
            //echo $flag;
            if($flag){
                self::$conn->commit();
            }else{
                self::$conn->rollback();
            }
            //$res->free(); 

        }else{
            $ret = "Connection Error";
        }
        
        self::$conn->close();
        return isset($ret) ? $ret : NULL; 
    }
}
