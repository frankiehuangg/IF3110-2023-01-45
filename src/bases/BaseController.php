<?php

abstract class BaseController {
    protected static $instance;
    protected $service;

    protected function __construct($service) {
        $this->service = $service;
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static(null);
        }

        return self::$instance;
    }

    protected function get($url_params) {
        throw new MethodNotAllowedException('Method not allowed');
    }

    protected function post($url_params) {
        throw new MethodNotAllowedException('Method not allowed');
    }

    protected function put($url_params) {
        throw new MethodNotAllowedException('Method not allowed');
    }

    protected function delete($url_params) {
        throw new MethodNotAllowedException('Method not allowed');
    }

    public function handle($method, $url_params) {
        $string_lower = strtolower($method);
        echo $this->$string_lower($url_params);
    }
}

?>
