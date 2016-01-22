<?php

$user = filter_input(INPUT_GET, 'user');
$password = filter_input(INPUT_GET, 'password');


$test = new User($user, $password);
$hash = $test->login();
//echo $hash;
//echo $test->getUser() . $test->getPass() .'';