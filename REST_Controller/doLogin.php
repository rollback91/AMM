<?php

$user = filter_input(INPUT_GET, 'user');
$password = filter_input(INPUT_GET, 'password');


$test = new User($user, $password);

echo $test->getUser() . $test->getPass() .'';