<?php
require_once './autoload.php';

is_dir('./tmp') ?: mkdir('./tmp');
// 获取到cookie
define('_Cookie', LoginController::login());

getData::getList();
