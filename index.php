<?php

require_once __DIR__ . '/vendor/autoload.php';

$config = \Utility\Helpers::merge(
    require __DIR__ . '/config/' . 'main.php',
    require __DIR__ . '/config/' . 'main-local.php'
);

\Utility\Helpers::C($config);

$params = new \Utility\Assignment();
$params = $params->assign();

$controllerStr = '\\Controllers\\' . $params['controller'];
$actionStr = $params['action'];

// controller文件
$controllerFile = __DIR__ . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . $params['controller'] . '.php';

is_file($controllerFile) ? $controllerObj = new $controllerStr() : die($controllerStr . '不存在');

method_exists($controllerObj, $actionStr) ? $controllerObj->$actionStr()
    : die($controllerStr . '->' . $actionStr . '不存在');
