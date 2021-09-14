<?php
namespace RikkaTech\SwooleHttp;

class AbstractController
{
    public $request;
    public $response;
    public function __construct($request,$response)
    {
        $this->request = $request;
        $this->response = $response;
    }
}