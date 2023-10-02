<?php

require_once PROJECT_ROOT_PATH . '/src/bases/BaseService.php';
require_once PROJECT_ROOT_PATH . '/src/repositories/PostRepository.php';
require_once PROJECT_ROOT_PATH . '/src/models/PostModel.php';

class PostService extends BaseService {
    protected static $instance;
    protected $repository;

    private function __construct($repository) {
        $this->repository = $repository;
    }

    public static function getInstance() {
        if (!(isset(self::$instance))) {
            self::$instance = new static(
                PostRepository::getInstance()
            );
        }

        return self::$instance;
    }

    public function getNLastPosts($n) {
        $postsSQL = $this->repository->getNLastRow($n);
        $posts = [];

        foreach ($postsSQL as $postSQL) {
            $post = new PostModel();
            $posts[] = $post->constructFromArray($postSQL);
        }

        return $posts;
    }
}

?>
