<?php

$user = filter_input(INPUT_GET, 'user');
$password = filter_input(INPUT_GET, 'password');


$test = new User($user, $password);
$hash = $test->login();
$ret = array("key"=>$hash);
die(json_encode($ret));

//echo $hash;
//echo $test->getUser() . $test->getPass() .'';