<?php

require_once PROJECT_ROOT_PATH . '/src/bases/BaseRepository.php';
require_once PROJECT_ROOT_PATH . '/src/models/LikeModel.php';

class LikeRepository extends BaseRepository {
    protected static $instance;
    protected $tableName = 'likes';

    private function __construct() {
        parent::__construct();
    }

    public static function getInstance() {
        if (!(isset(self::$instance))) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    public function getAll() {
        return $this->findAll();
    }

    public function getAllLikedPostId($username) {
        return $this->findAll([
            'username' => [0, $username, PDO::PARAM_STR, 0]
        ]);
    }

    public function getAllLikedPosts($username) {
        $likedPosts = $this->getAllLikedPostId($username);
        $sql = 'SELECT * FROM posts WHERE post_id IN (' . implode(',', array_map(function($likedPost) {
            return $likedPost->get('post_id');
        }, $likedPosts)) . ')';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'PostModel');
    }


}