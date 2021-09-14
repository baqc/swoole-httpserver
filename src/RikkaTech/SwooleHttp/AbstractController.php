<?php
namespace RikkaTech\SwooleHttp;

use Swoole\Http\Request;
use Swoole\Http\Response;

class AbstractController
{
    /** @var Request */
    public $request;
    /** @var Response */
    public $response;

    public function __construct($request,$response)
    {
        $this->request = $request;
        $this->response = $response;
    }
}