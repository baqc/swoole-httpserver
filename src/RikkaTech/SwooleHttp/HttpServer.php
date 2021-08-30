<?php
/**
 * HttpServer.php
 *
 * @project RinoBot
 * @author lixworth <lixworth@outlook.com>
 * @copyright RinoBot
 * @create 2021/8/26 20:35
 */

namespace RikkaTech\SwooleHttp;

use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Http\Server;
use Swoole\Process;

class HttpServer
{
    private Server $http;

    /**
     * @return Server
     */
    public function getHttp(): Server
    {
        return $this->http;
    }

    public function __construct(string $name = "default", string $ip = "127.0.0.1", int $port = 9502, $config = ['enable_coroutine' => true], $inside = true,$dispatcher = null,$logger = null)
    {
        $this->http = new Server($ip,$port);
        $this->http->set($config);

        $this->http->on('start',function () use ($name,$ip,$port,$config,$logger){
            if($logger !== null){
                $logger->getLogger()->info("Http Server: ".$name." is started at http://".$ip.":".$port);
                $logger->getLogger()->info("Start Config: ".json_encode($config));
            }
        });
        $this->http->on('request', function(Request $request, Response $response) use ($name,$inside,$dispatcher){
            if($inside){
                if ($request->server['path_info'] == '/favicon.ico' || $request->server['request_uri'] == '/favicon.ico') {
                    $response->end();
                    return;
                }
                if ($request->server['path_info'] == '/robots.txt' || $request->server['request_uri'] == '/robots.txt') {
//                    $response->end(file_get_contents(PUBLIC_DIR . "robot.txt"));
                    $response->end();
                    return;
                }
            }
            if($dispatcher !== null){
                $dispatch = $dispatcher->dispatch($request->getMethod(),$request->server["request_uri"]);
                switch ($dispatch[0]) {
                    case \FastRoute\Dispatcher::NOT_FOUND:
                        $response->end("404");
                        break;
                    case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                        $allowedMethods = $dispatch[1];
                        $response->end("405");
                        break;
                    case \FastRoute\Dispatcher::FOUND:
                        $target = explode("@",$dispatch[1]);
                        $action = $target[1];
                        (new $target[0]($request,$response))->$action($dispatch[2]);
                        break;
                    default:
                        $response->end("500");
                        break;
                }
            }else{
                SwooleRouter::dispatch($name,$request,$response);
            }
            return;
        });

        $this->http->start();

    }

    public function close()
    {
        $this->http->stop();
    }

}