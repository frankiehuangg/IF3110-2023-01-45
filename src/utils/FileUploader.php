<?php

include_once PROJECT_ROOT_PATH . '/src/utils/Logger.php';

class FileUploader {
    private static $instance;
    private $target_dir = "/files/";

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    private function generateRandomString($length = 40) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $character_len = strlen($characters);
        
        $random_string = '';
        for ($i = 0; $i < $length; $i++) {
            $random_string = $random_string . $characters[rand(0, $character_len - 1)];
        }

        return $random_string;
    }

    public function upload($file) {
        try {
            Logger::debug(json_encode($file));

            $relative_target = $this->target_dir . $this->generateRandomString() . '-' . basename($file['name']);
            $target_file = PROJECT_ROOT_PATH . $relative_target;

            if (!file_exists($target_file)) {
                if (move_uploaded_file($file['tmp_name'], $target_file)) {
                    return $relative_target;
                } else {
                    return false;
                }
            } else {
                return false;
            }
          } catch (Exception $e) {
            throw new Exception("Upload File Error: " . $e->getMessage());
          }
    }
}

?>