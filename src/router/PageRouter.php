<?php

class PageRouter {
    private $routes;
    private $errorRoute;

    public function __construct($routes) {
        $this->routes = $routes;
    }

    public function routing($path, $method) {
        $path = explode('?', $path)[0];

        foreach ($this->routes as $key => $val) {
            $match = $this->isMatch($path, $key);
            $_GLOBALS['__urlParams'] = $match[1];
            
            if ($match[0]) {
                require $val;
                exit();
            }
        }

        if (isset($this->errorRoute)) {
            require $this->errorRoute;
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }
    
    public function setErrorRoute($errorRoute) {
        $this->errorRoute = $errorRoute;
    }

    public function isMatch($path, $key_handler) {
        $path = explode('/', $path);
        $key_handler = explode('/', $key_handler);

        if (count($path) !== count($key_handler)) {
            return [false, []];
        }

        $url_params = [];

        for ($i = 0; $i < count($path); $i++) {
            if ($path[$i] !== $key_handler[$i] && $key_handler[$i] !== '*') {
                return [false, []];
            }
            
            if ($key_handler[$i] === '*') {
                $url_params[] = $path[$i];
            }
        }

        return [true, $url_params];
    }
}

?>