<?php

session_start();

require_once PROJECT_ROOT_PATH . '/src/bases/BaseService.php';
require_once PROJECT_ROOT_PATH . '/src/repositories/UserRepository.php';
require_once PROJECT_ROOT_PATH . '/src/models/UserModel.php';

class UserService extends BaseService {
    protected static $instance;
    protected $repository;

    private function __construct($repository) {
        $this->repository = $repository;
    }

    public static function getInstance() {
        if (!(isset(self::$instance))) {
            self::$instance = new static(
                UserRepository::getInstance()
            );
        }

        return self::$instance;
    }

    public function getByEmail($email) {
        $user = new UserModel();

        $user_sql = $this->repository->getByEmail($email);
        if ($user_sql) {
            $user->constructFromArray($user_sql);
        }

        return $user;
    }

    public function getById($id) {
        $user = new UserModel();

        $user_sql = $this->repository->getById($id);
        if ($user_sql) {
            $user->constructFromArray($user_sql);
        }

        return $user;
    }

    public function getByUsername($username) {
        $user = new UserModel();

        $user_sql = $this->repository->getByUsername($username);
        if ($user_sql) {
            $user->constructFromArray($user_sql);
        }

        return $user;
    }

    public function create($username, $email, $password) {
        $user = new UserModel();
        $user->set('username', $username);
        $user->set('email', $email);
        $user->set('password', $password);

        $put = $this->repository->insert($user, array(
            'username' => PDO::PARAM_STR,
            'email' => PDO::PARAM_STR,
            'password' => PDO::PARAM_STR
        ));

        $find = $this->repository->getById($put);
        $user = new UserModel();
        $user = $user->constructFromArray($find);


        $_SESSION['user_id'] = $user->user_id;
        $_SESSION['is_admin'] = $user->is_admin;

        return $user;
    }

    public function getNLastUsers($n) {
        $users_sql = $this->repository->getNLastRow($n);

        $users = [];

        if (isset($users_sql)) {
            foreach ($users_sql as $user_sql) {
                $user = new UserModel();
                $user->constructFromArray($user_sql);

                $users[] = $user;
            }
        }

        return $users;
    }

    public function updateUser(
        $user_id, 
        $username, 
        $password, 
        $email, 
        $description, 
        $display_name, 
        $birthday_date, 
        $birthday_month, 
        $birthday_year, 
        $profile_picture_path
    ) {
        $user = $this->getById($user_id);

        $params = [];

        if (isset($username)                ) { $user->set('username', $username);                          $params['username'] = PDO::PARAM_STR; }
        if (isset($password)                ) { $user->set('password', $password);                          $params['password'] = PDO::PARAM_STR; }
        if (isset($email)                   ) { $user->set('email', $username);                             $params['email'] = PDO::PARAM_STR; }
        if (isset($description)             ) { $user->set('description', $description);                    $params['description'] = PDO::PARAM_STR; }
        if (isset($display_name)            ) { $user->set('display_name', $display_name);                  $params['display_name'] = PDO::PARAM_STR; }
        if (isset($birthday_date)           ) { $user->set('birthday_date', $birthday_date);                $params['birthday_date'] = PDO::PARAM_INT; }
        if (isset($birthday_month)          ) { $user->set('birthday_month', $birthday_month);              $params['birthday_month'] = PDO::PARAM_INT; }
        if (isset($birthday_year)           ) { $user->set('birthday_year', $birthday_year);                $params['birthday_year'] = PDO::PARAM_INT; }
        if (isset($profile_picture_path)    ) { $user->set('profile_picture_path', $profile_picture_path);  $params['profile_picture_path'] = PDO::PARAM_STR; }
        
        $this->repository->update($user, $params);

        $user = $this->getById($user_id);

        return $user;
    }

    public function deleteUser($user_id) {
        $user = new UserModel();
        $user->set('user_id', $user_id);
        return $this->repository->delete($user);
    }
};

?>
