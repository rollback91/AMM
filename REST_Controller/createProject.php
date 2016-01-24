<?php
$key = filter_input(INPUT_GET, 'key');
$name = filter_input(INPUT_GET, 'name');
$description = filter_input(INPUT_GET, 'description');
//var_dump(perms::hCheck($key));
$id = perms::hCheck($key);

if($id){
    $project = new project($name, $description, $id);
    $project->save();
    
}else{
    die(json_encode(array('err' => 'not authorized')));
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

