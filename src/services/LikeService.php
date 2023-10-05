<?php

require_once PROJECT_ROOT_PATH . '/src/bases/BaseService.php';
require_once PROJECT_ROOT_PATH . '/src/bases/BaseRepository.php';
require_once PROJECT_ROOT_PATH . '/src/models/LikeModel.php';
require_once PROJECT_ROOT_PATH . '/src/repositories/LikeRepository.php';

class LikeService extends BaseService {
    protected static $instance;
    protected $like_repository;
    protected $post_repository;

    private function __construct($like_repository,$post_repository) {
        $this->like_repository = $like_repository;
        $this->post_repository = $post_repository;
    }

    public static function getInstance() {
        if (!(isset(self::$instance))) {
            self::$instance = new static(
                LikeRepository::getInstance(),
                PostRepository::getInstance()
            );
        }

        return self::$instance;
    }

    public function getLikedPosts($username) {
        $postsSQL = $this->repository->getAllLikedPostId($username);
        return $postsSQL;
    }

    public function likePost($user_id,$post_id) {
        $likes = new LikeModel();

        $likes->set('username', $user_id);
        $likes->set('post_id', $post_id);

        $last_likes_id = $this->like_repository->insert($likes, array(
            'username' => PDO::PARAM_STR,
            'post_id' => PDO::PARAM_INT
        ));

        $likes_sql = $this->like_repository->getByID($last_likes_id);

        $result_likes = new LikeModel();
        $result_likes->constructFromArray($likes_sql);

        return $result_likes;
    }
}
