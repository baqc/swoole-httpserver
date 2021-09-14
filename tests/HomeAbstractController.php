<?php

/**
 * HomeController.php
 *
 * @project swoole-httpserver
 * @author lixworth <lixworth@outlook.com>
 * @copyright swoole-httpserver
 * @create 2021/8/31 5:52
 */
class HomeAbstractController extends AbstractController
{
    public function index()
    {
        $this->response->end("2333");
    }
}