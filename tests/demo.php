<?php
/**
 * demo.php
 *
 * @project swoole-httpserver
 * @author lixworth <lixworth@outlook.com>
 * @copyright swoole-httpserver
 * @create 2021/8/31 5:34
 */

require_once __DIR__ . "/../vendor/autoload.php";


$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $routeCollector) {
    $routeCollector->addRoute('GET', '/', 'HomeController@index');
});

class LoggerInterface extends Logger {

    public function getLogger()
    {
        return self::$instance;
    }
}
$server = new \RikkaTech\SwooleHttp\HttpServer("default","127.0.0.1",9501,$config = ['enable_coroutine' => true],true,$dispatcher,new LoggerInterface());
