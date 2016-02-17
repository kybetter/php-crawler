<?php

class getData
{
    public static $header = array(
        "Cookie: " . _Cookie,
        'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36',
        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
        'X-Requested-With: XMLHttpRequest',
    );
    public static function getList()
    {
        is_dir(__DIR__ . '/tmp/list') ?: mkdir(__DIR__ . '/tmp/list');
        $pattern = "/<a href=\"(\/pt\/\w{10}\/detail)\">/is";
        for ($i = 1; $i <= 10; $i++) {
            $listData = Helpers::httpGet(webSite::listUrl($i), self::$header);
            preg_match_all($pattern, $listData, $res);
            $res = var_export($res[1], true);

            // var_dump($res);
            file_put_contents(__DIR__ . '/tmp/list/list' . $i . '.html', $res);
        }

    }
}
