<?php

abstract class BaseService {
    protected static $instance;
    protected $repository;

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }
        
        return self::$instance;
    }
}
?>
