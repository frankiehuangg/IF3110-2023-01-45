<?php

require_once PROJECT_ROOT_PATH . '/src/bases/BaseService.php';
require_once PROJECT_ROOT_PATH . '/src/repositories/PostRepository.php';
require_once PROJECT_ROOT_PATH . '/src/repositories/ResourceRepository.php';
require_once PROJECT_ROOT_PATH . '/src/models/PostModel.php';
require_once PROJECT_ROOT_PATH . '/src/models/ResourceModel.php';

class PostService extends BaseService {
    protected static $instance;
    protected $post_repository;
    protected $resource_repository;

    private function __construct($post_repository, $resource_repository) {
        $this->post_repository = $post_repository;
        $this->resource_repository = $resource_repository;
    }

    public static function getInstance() {
        if (!(isset(self::$instance))) {
            self::$instance = new static(
                PostRepository::getInstance(),
                ResourceRepository::getInstance()
            );
        }

        return self::$instance;
    }

    public function getAll(
        $post_content, 
        $order_by = '', 
        $sort_res = 0, 
        $page_no = null, 
        $page_size = null
    ) {
        $where['post_content'] = [1, $post_content, PDO::PARAM_STR];

        $posts_sql = $this->post_repository->findAll($where, $order_by, $sort_res, $page_no, $page_size);

        $posts = [];
        foreach ($posts_sql as $post_sql) {
            $post = new PostModel();
            $posts[] = $post->constructFromArray($post_sql);
        }

        return $posts;
    }

    public function createPost($post_content, $post_resources) {
        $post = new PostModel();

        $post->set('post_content', $post_content);

        $post_last_id = $this->post_repository->insert($post, array(
            'post_content' => PDO::PARAM_STR
        ));

        $post_sql = $this->post_repository->getByID($post_last_id);

        $result_post = new PostModel();
        $result_post->constructFromArray($post_sql);

        $result_resource = array();
        foreach ($post_resources as $post_resource) {
            $resource = new ResourceModel();

            $resource->set('post_id', $post_last_id);
            $resource->set('resource_path', $post_resource);

            $resource_last_id = $this->resource_repository->insert($resource, array(
                'post_id'       => PDO::PARAM_INT,
                'resource_path' => PDO::PARAM_STR
            ));
            $result_sql = $this->resource_repository->getByID($resource_last_id);

            $resource_model = new ResourceModel();
            $resource_model->constructFromArray($result_sql);
            $result_resource[] = $resource_model;
        }

        return [$result_post, $result_resource];
    }

    public function getNLastPosts($n) {
        $postsSQL = $this->post_repository->getNLastRow($n);
        $posts = [];

        foreach ($postsSQL as $postSQL) {
            $post = new PostModel();
            $posts[] = $post->constructFromArray($postSQL);
        }

        return $posts;
    }
}

?>
