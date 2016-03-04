<?php

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
        curl_setopt($curl, CURLOPT_HEADER, true); //设为true则会有response header
        if ($header) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header); // 设置请求header
        }
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data); //POST发送字段
        $res = curl_exec($curl); //执行
        curl_close($curl);

        return $res; //返回结果集
    }
}
