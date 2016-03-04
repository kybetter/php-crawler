<?php
/**
 * 配置文件,自行设置: key=>value
 * Created by PhpStorm.
 * User: kybetter
 * Date: 16/3/4
 * Time: 上午11:01
 */

$config = [
    'home_path' => realpath(__DIR__ . '/../'),
    'main_page' => '要抓取的网站主域名',
    'login_acount' => '要登录的账号',
    'login_password' => '密码',
];

return $config;