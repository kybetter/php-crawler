<?php
/**
 * Created by PhpStorm.
 * User: kybetter
 * Date: 16/3/4
 * Time: 上午11:45
 */
namespace Controllers;
use Utility\Helpers;

class IndexController extends Controller
{
    public function actionIndex()
    {
        $login = $this->login();
        if ($login) {
            echo 'login success';
        } else {
            echo 'login faild';
        }
    }

    public function login()
    {
        is_dir(Helpers::C('home_path') . '/tmp') ?: mkdir(Helpers::C('home_path') . '/tmp');
        $login_cookie_file = Helpers::C('home_path') . '/tmp/login_cookie.php';
        // 如果有cookie文件
        if (is_file($login_cookie_file)) {
            $cookie = require $login_cookie_file;
        } else {
            // 登录
            $data = 'user_acc=' . Helpers::C('login_account')
                . '&user_pwd=' . Helpers::C('login_password');
            $subject = Helpers::httpPost(Helpers::C('login_page'), $data);
            $login_info_written = file_put_contents(Helpers::C('home_path') . '/tmp/login_info', $subject);
            if (!$login_info_written) {
                return null;
            }
            $pattern = "/Set-Cookie:\s(\w+?=[0-9a-zA-Z_%]+?);/is";
            $has_cookie = preg_match($pattern, $subject, $arr);

            if (!$has_cookie) {
                return null;
            }
            $session_arr = "<?php\r\n return '$arr[1]';\r\n";
            $cookie_written = file_put_contents($login_cookie_file, $session_arr);
            if (!$cookie_written) {
                return null;
            }
            $cookie = $arr[1];
        }
        return $cookie;
    }
}