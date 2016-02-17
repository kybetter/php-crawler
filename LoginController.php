<?php

class LoginController
{
    public static function login()
    {
        $login_cookie_file = './tmp/login_cookie.php';
        // 如果有cookie文件
        if (is_file($login_cookie_file)) {

            $cookie = include $login_cookie_file;

        } else {
            // 登录
            $data = 'user_acc=&user_pwd=123123';

            $subject = $res = Helpers::httpPost('', $data);

            $login_info_written = file_put_contents('./tmp/login_info', $res);

            if (!$login_info_written) {
                die("can't write file: login_info.");
            }

            $pattern = "/Set-Cookie:\s(\w+?=[0-9a-zA-Z_%]+?);/is";

            $has_cookie = preg_match($pattern, $subject, $arr);

            if (!$has_cookie) {
                die("can't find cookie");
            }

            $session_arr = <<<ss
<?php
return '$arr[1]';
ss;

            $cookie_written = file_put_contents($login_cookie_file, $session_arr);
            if (!$cookie_written) {
                die("can't write file: {$login_cookie_file}.");
            }
            $cookie = $arr[1];

        }

        return $cookie;
    }
}
