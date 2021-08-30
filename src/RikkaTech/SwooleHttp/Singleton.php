<?php
/**
 * Singleton.php
 *
 * @project swoole-httpserver
 * @author lixworth <lixworth@outlook.com>
 * @copyright swoole-httpserver
 * @create 2021/8/31 4:27
 */

namespace RikkaTech\SwooleHttp;

class Singleton
{
    protected static ?self $instance = null;

    public function __construct()
    {
        self::$instance = $this;
    }

    private static function make(): self
    {
        return new self;
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = self::make();
        }
        return self::$instance;
    }

    public static function setInstance(self $instance): void
    {
        self::$instance = $instance;
    }

    public static function reset(): void
    {
        self::$instance = null;
    }
}