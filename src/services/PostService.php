<?php

require_once PROJECT_ROOT_PATH . '/src/bases/BaseService.php';
require_once PROJECT_ROOT_PATH . '/src/repositories/PostRepository.php';
require_once PROJECT_ROOT_PATH . '/src/repositories/ResourceRepository.php';
require_once PROJECT_ROOT_PATH . '/src/models/PostModel.php';
require_once PROJECT_ROOT_PATH . '/src/models/ResourceModel.php';

class PostService extends BaseService {
    protected static $instance;
    protected $user_repository;
    protected $post_repository;
    protected $resource_repository;

    private function __construct($post_repository, $user_repository, $resource_repository) {
        $this->post_repository      = $post_repository;
        $this->user_repository      = $user_repository;
        $this->resource_repository  = $resource_repository;
    }

    public static function getInstance() {
        if (!(isset(self::$instance))) {
            self::$instance = new static(
                PostRepository::getInstance(),
                UserRepository::getInstance(),
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

    public function getAllByUserID($user_id) {
        $where['user_id'] = [0, $user_id, PDO::PARAM_INT];

        $posts_sql = $this->post_repository->findAll($where);

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
        $post->set('user_id', $_SESSION['user_id']);

        $post_last_id = $this->post_repository->insert($post, array(
            'user_id'      => PDO::PARAM_INT,
            'post_content' => PDO::PARAM_STR
        ));

        $post_sql = $this->post_repository->getByID($post_last_id);

        $result_post = new PostModel();
        $result_post->constructFromArray($post_sql);

        $result_resource = array();
        if (isset($post_resources)) {
            foreach ($post_resources as $post_resource) {
                $resource = new ResourceModel();
    
                $resource->set('post_id', $post_last_id);
                $resource->set('resource_path', $post_resource);
    
                $this->resource_repository->insert($resource, array(
                    'post_id'       => PDO::PARAM_INT,
                    'resource_path' => PDO::PARAM_STR
                ));

                $resource_model = new ResourceModel();
                $resource_model->constructFromArray([
                    'post_id'       => $post_last_id,
                    'resource_path' => $post_resource
                ]);
                $result_resource[] = $resource_model;
            }
        }

        return [$result_post, $result_resource];
    }

    public function getPostByID($post_id) {
        $post_sql = $this->post_repository->getByID($post_id);

        $post = new PostModel();
        $post->constructFromArray($post_sql);

        $user_id = $post->get('user_id');
        $user_sql = $this->user_repository->findOne([
            'user_id'   => [$user_id, PDO::PARAM_INT]
        ]);
        $user = new UserModel();
        $user->constructFromArray($user_sql);

        $resources = [];
        $resources_sql = $this->resource_repository->findAll([
            'post_id'   => [0, $post->get('post_id'), PDO::PARAM_INT]
        ]);
        foreach ($resources_sql as $resource_sql) {
            $resource = new ResourceModel();
            $resource->constructFromArray($resource_sql);
            $resources[] = $resource;
        }

        return [$post, $user, $resources];
    }

    public function getNLastPosts($n) {
        $posts_sql = $this->post_repository->getNLastRow($n);

        $posts = [];

        if (isset($posts_sql)) {
            foreach ($posts_sql as $post_sql) {
                $post = new PostModel();
                $post->constructFromArray($post_sql);

                $user_id = $post->get('user_id');
                $user_sql = $this->user_repository->findOne([
                    'user_id'   => [$user_id, PDO::PARAM_INT]
                ]);
                $user = new UserModel();
                $user->constructFromArray($user_sql);

                $resources = [];
                $resources_sql = $this->resource_repository->findAll([
                    'post_id'   => [0, $post->get('post_id'), PDO::PARAM_INT]
                ]);
                foreach ($resources_sql as $resource_sql) {
                    $resource = new ResourceModel();
                    $resource->constructFromArray($resource_sql);
                    $resources[] = $resource;
                }

                $posts[] = [$post, $user, $resources];
            }
        }

        return $posts;
    }

    public function updatePost($post_id, $post_content) {
        $post = $this->getPostByID($post_id)[0];
        $post->set('post_content', $post_content);

        $this->post_repository->update($post, array(
            'post_content'  => PDO::PARAM_STR
        ));

        $post = $this->getPostByID($post_id);

        return $post;
    }

    public function deletePost($post_id) {
        $post = new PostModel();
        $post->set('post_id', $post_id);
        return $this->post_repository->delete($post);
    }
}

?>
