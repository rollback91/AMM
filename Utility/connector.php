<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Connector {

    private $servername = "localhost";
    private $username = "root";
    private $password = "davide";
    private $conn;
    private static function initialize() {
        // Create connection
        $conn = new mysqli($this->$servername, $this->$username, $this->$password);

        // Check connection
        if ($conn->connect_error) {
            return -1;
        }
        return 0;
    }

    static function query($query, $elements) {
        $check = self::initialize();
        $params = array();
        if ($check >= 0) {
            $stmt = $conn->prepare($query);
            
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
        self::close();
        die("Connection Error");
    }
    
    private static function close(){
        $conn.close();
    }

}
