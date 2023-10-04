<?php

define("PROJECT_ROOT_PATH", __DIR__ . '/..');

require_once PROJECT_ROOT_PATH . '/api/routes.php';
require_once PROJECT_ROOT_PATH . '/src/router/APIRouter.php';

require_once PROJECT_ROOT_PATH . '/src/controllers/shared/CheckHealthController.php';

require_once PROJECT_ROOT_PATH . '/src/middlewares/CheckAdmin.php';

require_once PROJECT_ROOT_PATH . '/src/controllers/posts/PostController.php';
require_once PROJECT_ROOT_PATH . '/src/controllers/posts/CreatePostController.php';

require_once PROJECT_ROOT_PATH . "/src/controllers/upload/FileUploadController.php";

$routeHandler = new APIRouter();

$routeHandler->addHandler('/api', CheckHealthController::getInstance(), []);

$routeHandler->addHandler('/api/post', PostController::getInstance(), []);

$routeHandler->addHandler('/api/post/create', CreatePostController::getInstance(), []);

$routeHandler->addHandler('/api/upload', FileUploadController::getInstance (), []);

$routeHandler->run($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

?>
