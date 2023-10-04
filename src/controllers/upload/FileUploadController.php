<?php

require_once PROJECT_ROOT_PATH . '/src/bases/BaseController.php';
require_once PROJECT_ROOT_PATH . '/src/utils/FileUploader.php';
require_once PROJECT_ROOT_PATH . '/src/exceptions/BadRequestException.php';

class FileUploadController extends BaseController {
    protected static $instance;
    protected $service;

    private function __construct($service) {
        parent::__construct($service);
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static(
                FileUploader::getInstance()
            );
        }

        return self::$instance;
    }

    public function post($url_params) {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

        $file_uploader = FileUploader::getInstance();
        $path = $file_uploader->upload($_FILES['file']);
        $is_success = ($path !== false);

        if (!$is_success) {
            throw new BadRequestException('Failed to upload file');
        }

        $response = new BaseResponse(true, $path, 'File uploaded successfully', 200);
        return $response->toJSON();
    }
};

?>