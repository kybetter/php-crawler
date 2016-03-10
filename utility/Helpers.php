<?php
namespace Utility;

class Helpers
{
    public static function httpGet($url, $header = null)
    {
        $curl = curl_init(); //curl初始化
        //设置选项
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //获取到的信息以文件流的形式返回
        curl_setopt($curl, CURLOPT_TIMEOUT, 500); //设置cURL允许执行的最长秒数。要发短信，就设为5
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //禁用后cURL将终止从服务端进行验证
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); //不检查SSL HOST
        curl_setopt($curl, CURLOPT_URL, $url); //设置发送的URL
        // curl_setopt($curl, CURLOPT_COOKIE, $cookie);// cookie
        // curl_setopt($curl, CURLOPT_USERAGENT, $cookie);// ua
        if ($header) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header); // header
        }
        $res = curl_exec($curl); //执行
        curl_close($curl);

        return $res; //返回结果集
    }
    public static function httpPost($url, $data, $header = null)
    {
        $curl = curl_init(); //curl初始化
        //设置选项
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //获取到的信息以文件流的形式返回
        curl_setopt($curl, CURLOPT_POST, true); //POST
        curl_setopt($curl, CURLOPT_TIMEOUT, 500); //设置cURL允许执行的最长秒数。要发短信，就设为5
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //禁用后cURL将终止从服务端进行验证
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); //不检查SSL HOST
        curl_setopt($curl, CURLOPT_URL, $url); //设置发送的URL
        curl_setopt($curl, CURLOPT_HEADER, false); //设为true则会有response header
        if ($header) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header); // 设置请求header
        }
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data); //POST发送字段
        $res = curl_exec($curl); //执行
        curl_close($curl);

        return $res; //返回结果集
    }

    /**
     * stolen from Yii2:
     *
     * Merges two or more arrays into one recursively.
     * If each array has an element with the same string key value, the latter
     * will overwrite the former (different from array_merge_recursive).
     * Recursive merging will be conducted if both arrays have an element of array
     * type and are having the same key.
     * For integer-keyed elements, the elements from the latter array will
     * be appended to the former array.
     * @param array $a array to be merged to
     * @param array $b array to be merged from. You can specify additional
     * arrays via third argument, fourth argument etc.
     * @return array the merged array (the original arrays are not changed.)
     */
    public static function merge($a, $b)
    {
        $args = func_get_args();
        $res = array_shift($args);
        while (!empty($args)) {
            $next = array_shift($args);
            foreach ($next as $k => $v) {
                if (is_int($k)) {
                    if (isset($res[$k])) {
                        $res[] = $v;
                    } else {
                        $res[$k] = $v;
                    }
                } elseif (is_array($v) && isset($res[$k]) && is_array($res[$k])) {
                    $res[$k] = self::merge($res[$k], $v);
                } else {
                    $res[$k] = $v;
                }
            }
        }

        return $res;
    }

    /**
     * C函数,设置和读取配置
     * @param null $key
     * @param null $value
     * @return array
     */
    public static function C($key = null, $value = null) {
        static $config = array();
        // 为空 则读取配置内容
        if (is_null($key)) {
            return $config;
        }
        if (is_string($key)) {
            $key = strtoupper($key);
            //$value为空,就为读取配置
            if (is_null($value)) {
                return isset($config[$key]) ? $config[$key] : [];
            }
            //$value不为空,设置值
            $config[$key] = $value;
        }
        // 如果是数组 就与前数组合并 存入静态变量
        if (is_array($key)) {
            $config = array_merge($config,array_change_key_case($key,CASE_UPPER));
        }
    }

}
