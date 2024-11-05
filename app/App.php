<?php

namespace App;

class App
{
    protected string $baseUrl;
    protected string $jstokUrl = 'http://10.10.2.20/fes/export/stock-awal-monthly-report-consigment-systems-export.php';

    /**
     * Data sub regions
     *
     * @var array
     */
    protected array $regions = [
        ["id" => "32", "name" => "JABO 1"],
        ["id" => "33", "name" => "JABO 2"],
        ["id" => "34", "name" => "JABO 3"],
        ["id" => "35", "name" => "JABO 4"],
        ["id" => "36", "name" => "JABO 5"],
        ["id" => "37", "name" => "JABO 6"],
        ["id" => "38", "name" => "JABO 7"],
        ["id" => "39", "name" => "JABO 8"],
        ["id" => "40", "name" => "JABO 9"],
        ["id" => "16", "name" => "SR 1"],
        ["id" => "17", "name" => "SR 2"],
        ["id" => "18", "name" => "SR 3"],
        ["id" => "29", "name" => "SR 4"],
        ["id" => "26", "name" => "SR 5"],
        ["id" => "30", "name" => "SR 6"]
    ];

    protected static App $app;

    public function __construct()
    {
        $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://';
        $host = $_SERVER['HTTP_HOST'];

        $this->baseUrl = "{$protocol}{$host}/stock-awal";
    }

    /**
     * Base url
     *
     * @param string $path
     * @return string
     */
    public static function baseUrl(string $path = '/'): string
    {
        static::$app = new static();
        return static::$app->baseUrl . '/' . ltrim($path, '/');
    }

    /**
     * Base url
     *
     * @param string $path
     * @return string
     */
    public static function jstockUrl(string $path = '/'): string
    {
        static::$app = new static();
        return static::$app->jstokUrl . ltrim($path, '/');
    }

    /**
     * Menambil data sub region
     *
     * @return array
     */
    public static function regions(): array
    {
        static::$app = new static();
        return static::$app->regions;
    }
}
