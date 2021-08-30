<?php

/**
 * Controller.php
 *
 * @project swoole-httpserver
 * @author lixworth <lixworth@outlook.com>
 * @copyright swoole-httpserver
 * @create 2021/8/31 5:52
 */
class Controller
{
    public $request;
    public $response;
    public function __construct($request,$response)
    {
        $this->request = $request;
        $this->response = $response;
    }
}