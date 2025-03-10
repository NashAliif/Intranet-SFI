<?php

class App
{
    public $controller = 'dashboard';
    public $method = 'index';
    public $params = [];

    public function __construct()
    {
        $url = $this->parseURL();

        if (isset($url[0])) {
            if (file_exists('../intranet/app/controllers/' . $url[0] . '.php')) {
                $this->controller = $url[0];
                unset($url[0]);
            } elseif (!empty($url[0]) && !file_exists($url[0])) {
                $this->controller = 'error404';
            }
        }

        require_once '../intranet/app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            } elseif (!empty($url[1]) && !method_exists($this->controller, $url[1])) {
                $this->controller = 'error404';
                $this->method = 'index';
                require_once '../intranet/app/controllers/' . $this->controller . '.php';
                $this->controller = new $this->controller;
            }
        }

        if (!empty($url)) {
            $this->params = array_values($url);
        }

        call_user_func_array([$this->controller, $this->method], $this->params);
    }


    public function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            return $url;
        }
    }
}
