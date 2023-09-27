<?php

abstract class BaseController {
    protected static $instance;
    protected $srv;

    protected function __construct($srv) {
        $this->srv = $srv;
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static(null);
        }

        return self::$instance;
    }

    protected function get($urlParams) {
    }

    protected function post($urlParams) {
    }

    protected function put($urlParams) {
    }

    protected function delete($urlParams) {
    }
}

>
