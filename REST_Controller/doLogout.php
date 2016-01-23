<?php

$key = filter_input(INPUT_GET, 'key');

$logout = User::logout($key);

die(json_encode($logout));

