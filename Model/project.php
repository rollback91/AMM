<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of project
 *
 * @author amm
 */
class project {
    private $name;
    private $description;
    private $insertBy;
    
    function __construct($name, $description, $insertBy) {
        $this->name = $name;
        $this->description = $description;
        $this->insertBy = $insertBy;
    }
    public function getName(){
        return $this->name;
    }
    public function setName($name){
        $this->name = $name;
    }
    public function getDescr(){
        return $this->description;
    }
    public function setDescr($description){
        $this->description = $description;
    }
    public function save(){
        $q = [];
        $id = Connector::query('SELECT MAX(id) FROM projects');
        $id = $id[0]['MAX(id)'] > 0 ? $id[0]['MAX(id)']+1 : 1;
        
        //echo $id;
        array_push($q,"INSERT INTO projects (id, name, description, insertBy) VALUES(".$id.",'".$this->name."','".$this->description."',".$this->insertBy.")");
        array_push($q,"INSERT INTO users_projects VALUES('".$this->insertBy."','".$id."')");
        $res = Connector::queryTran($q);
        //print_r($res);
    }
}
