<?php

abstract class BaseModel {
    public $_primary_key = "";

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

    public function getPrimaryKey() { return $this->_primarykey; }

    abstract public function constructFromArray($array);
}

?>
