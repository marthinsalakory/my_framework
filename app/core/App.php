<?php

class App
{
    protected $controller = '';
    protected $method = '';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseURL();
        $routes = $this;

        require_once __DIR__ . '/Routes.php';

        if (empty($this->controller)) {
            echo "<div style='text-align:center; background-color: red; color: white; margin-top: 200px;'><b><h1>ERROR 404</h1><h3>Halaman tidak ditemukan</h3></b></div>";
            die;
        }
        require_once __DIR__ . '/../controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // method
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[0]);
                unset($url[1]);
            }
        }

        // params
        if (!empty($url)) {
            $this->params = array_values($url);
        }

        // jalankan controller & method, serta kirimkan params jika ada
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function get($from, $to)
    {
        $from = rtrim($from, '/');
        $to = rtrim($to, '/');
        $to = explode('::', $to);
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);

            if ($url == $from) {
                if (file_exists(__DIR__ . '/../controllers/' . $to[0] . '.php')) {
                    $this->controller = $to[0];
                    $this->method = $to[1];
                }
            }
        }

        if (empty($from) && empty($_GET['url'])) {
            if (file_exists(__DIR__ . '/../controllers/' . $to[0] . '.php')) {
                $this->controller = $to[0];
                $this->method = $to[1];
            }
        }
    }

    public function setAutoRoute($key = false)
    {
        $url = $this->parseURL();
        if ($key == true) {
            // controller
            if (!empty($url)) {
                if (file_exists(__DIR__ . '/../controllers/' . $url[0] . '.php')) {
                    $this->controller = $url[0];
                }
            }
        }
    }

    public function setDefauldController($controller)
    {
        $this->controller = $controller;
    }

    public function setDefauldMethod($method)
    {
        $this->method = $method;
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
