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

    }

    /**
     * 登录获取cookie
     */
    public function actionLogin()
    {
        $login = $this->login();
        if ($login) {
            echo 'login success';
        } else {
            echo 'login faild';
        }
    }

    /**
     * 获取列表,写入文件
     */
    public function actionList()
    {
        $this->getList(1);
    }

    public function actionDetail()
    {
        $this->getDetail();
    }

    /**
     * 解析列表
     * @param $nums
     */
    private function getList($nums)
    {
        is_dir(Helpers::C('home_path') . '/tmp/list') ?: mkdir(Helpers::C('home_path') . '/tmp/list');
        $pattern = Helpers::C('list_pattern');
        for ($i = 1; $i <= $nums; $i++) {
            $listData = Helpers::httpGet($this->listUrl($i), Helpers::C('header'));
            preg_match_all($pattern, $listData, $res);
            $res = "<?php\r\n return " . var_export($res[1], true) . "\r\n";
            file_put_contents(Helpers::C('home_path') . '/tmp/list/' . $i . '.php', $res);
        }

    }

    /**
     * 解析详情
     */
    private function getDetail($id)
    {
        Helpers::httpGet($this->detailUrl($id), Helpers::C('header'));
    }

    /**
     * 设置列表的url
     * @param $page
     * @return string
     */
    private function listUrl($page)
    {
        $listUrl = Helpers::C('list_url') . '?page=%d';
        return sprintf($listUrl, (int) $page);
    }

    /**
     * 设置详情的url
     * @param string $id
     * @return string
     */
    private function detailUrl($id)
    {
        $detailUrl = Helpers::C('main_page') . '/pt/%s/detail';
        return sprintf($detailUrl, $id);
    }

    /**
     * 登录拿到cookie
     * @return mixed|null
     */
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
            $subject = Helpers::httpPost(Helpers::C('login_page'), $data, Helpers::C('header'));
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