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
        $this->_controller = htmlspecialchars(trim($_GET['c']));
        $this->_action = htmlspecialchars(trim($_GET['a']));
    }

    public static function assign()
    {
        $controller = empty(self::_controller) ? 'Index' : self::_controller;
        $action = empty(self::_action) ? 'index' : self::_action;
        return [
            $controller,
            $action,
        ];
    }

}
