<?php

require_once PROJECT_ROOT_PATH . '/src/bases/BaseController.php';
require_once PROJECT_ROOT_PATH . '/src/services/PostService.php';
require_once PROJECT_ROOT_PATH . '/src/components/PostCard.php';

class SearchPostController extends BaseController {
    protected static $instance;

    private function __construct($service) {
        parent::__construct($service);
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static(
                PostService::getInstance()
            );
        }

        return self::$instance;
    }

    public function get($urlParams) {
        $search_val = $_GET['search_str'];
        
        $response = $this->service->getAllByPostContent($search_val);
        
        $html = "";
        foreach($response as $res) {
            $resource = [];
            foreach ($res[2] as $resors) {
                $resource[] = $resors->toResponse();
            }

            $html = $html . PostCard([$res[0]->toResponse(), $res[1]->toResponse(), $resource]);
        }

        $response = new BaseResponse(true, $html, 'Post searched successfully', 200);

        return $response->toJSON();
    }
};

?>