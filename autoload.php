<?php

class AutoLoadClass
{

    public function __construct()
    {
        // spl_autoload_register(array(__CLASS__, 'autoload'));
        spl_autoload_register(array($this, 'autoload'));
    }

    private function autoload($className)
    {
        include_once __DIR__ . '/' . $className . '.php';
    }

}
new AutoLoadClass();
