<?php

class BaseResponse {
    public $success;
    public $data;
    public $message;
    public $status_code;

    public function __construct($success, $data, $message, $status_code) {
        $this->success = $success;
        $this->data = $data;
        $this->message = $message;
        $this->status_code = $status_code;
    }

    public function toJSON() {
        return json_encode($this);
    }
}

?>
