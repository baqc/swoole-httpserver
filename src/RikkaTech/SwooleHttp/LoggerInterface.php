<?php
/**
 * LoggerInterface.php
 *
 * @project swoole-httpserver
 * @author lixworth <lixworth@outlook.com>
 * @copyright swoole-httpserver
 * @create 2021/9/14 23:23
 */

namespace RikkaTech\SwooleHttp;

class LoggerInterface extends \RikkaTech\SwooleHttp\Logger {

    public function getLogger()
    {
        return self::$instance;
    }
}
