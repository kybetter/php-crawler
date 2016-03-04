<?php
/**
 * 用于处理get参数,并分配到相应的Controller中的action中
 * Created by PhpStorm.
 * User: kybetter
 * Date: 16/3/4
 * Time: 上午9:56
 */
namespace Utility;

class Assignment
{
    private $_controller;
    private $_action;

    public function __construct()
    {
        $c = isset($_GET['c']) ? $_GET['c'] : 'Index';
        $a = isset($_GET['a']) ? $_GET['a'] : 'index';
        $this->_controller = htmlspecialchars(trim($c));
        $this->_action = htmlspecialchars(trim($a));
    }

    public function assign()
    {
        $controller = empty($this->_controller) ? 'Index' : $this->_controller;
        $action = empty($this->_action) ? 'index' : $this->_action;
        return [
            'controller' =>ucfirst($controller) . 'Controller',
            'action' => 'action' . ucfirst($action),
        ];
    }

}
