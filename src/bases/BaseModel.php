<?php

abstract class BaseModel {
    public $_primarykey = "";

    public function __construct() {
        return $this;
    }

    public function set($attr, $value) {
        $this->$attr = $value;
        return $this;
    }

    public function get($attr) {
        return $this->$attr;
    }

    abstract public function constructFromArray($array);
}

>
