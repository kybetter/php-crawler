<?php

use Utility\Assignment;

require_once __DIR__ . '/vendor/autoload.php';

//require_once __DIR__ . '/utility/Assignment.php';

//is_dir('./tmp') ?: mkdir('./tmp');
// 获取到cookie
//define('_Cookie', LoginController::login());

//getData::getList();

$params = Assignment::assign();

print_r($params);
