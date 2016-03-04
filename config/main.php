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
    'header' => [
        'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36',
        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
        'X-Requested-With: XMLHttpRequest',
//        "Cookie: 请使用Index->login获取后再设置",
    ],
    'main_page' => '要抓取的网站主域名',
    'login_acount' => '要登录的账号',
    'login_password' => '密码',
    'list_pattern' => "/<a href=\"(\/pt\/\w{10}\/detail)\">/is",
    'list_url' => 'your define',
];

return $config;