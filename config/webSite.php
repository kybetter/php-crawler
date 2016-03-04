<?php


class webSite
{
    public static $website = array(
        'login' => '',
        'main' => '',
    );

    public static function listUrl($page)
    {
        $listUrl = self::$website['main'] . '?page=%d';
        return sprintf($listUrl, (int) $page);
    }

    public static function detailUrl(string $id)
    {
        $detailUrl = $this->website['main'] . '/pt/%s/detail';
        return sprintf($detailUrl, $id);
    }
}
