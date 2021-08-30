<?php
/**
 * Logger.php
 *
 * @project swoole-httpserver
 * @author lixworth <lixworth@outlook.com>
 * @copyright swoole-httpserver
 * @create 2021/8/31 5:54
 */

use RikkaTech\SwooleHttp\Singleton;

class Logger extends Singleton
{
    private $format = "";

    public static function template($from, $type, $message): string
    {
        return "[" . date("Y/H/D h:m:s") . "][" . $type . "][" . $from . "] " . $message . "\n";
    }

    /**
     * @param $message
     * @param string $from
     * @return string
     */
    public function info($message, string $from = 'Server'): void
    {
        fwrite(STDOUT, self::template($from, "INFO", $message));
    }

    /**
     * @param $message
     * @param string $from
     * @return string
     */
    public function success($message, string $from = 'Server'): void
    {
        fwrite(STDOUT, self::template($from, "SUCCESS", $message));
    }

    /**
     * @param $message
     * @param string $from
     * @return string
     */
    public function error($message, string $from = 'Server'): void
    {
        fwrite(STDOUT, self::template($from, "ERROR", $message));
    }
}