<?php

define("PROJECT_ROOT_PATH", __DIR__ . '/..');

require_once PROJECT_ROOT_PATH . '/api/routes.php';
require_once PROJECT_ROOT_PATH . '/src/router/APIRouter.php';

require_once PROJECT_ROOT_PATH . '/src/controllers/shared/CheckHealthController.php';

require_once PROJECT_ROOT_PATH . '/src/middlewares/CheckAdmin.php';

require_once PROJECT_ROOT_PATH . '/src/controllers/posts/PostController.php';
require_once PROJECT_ROOT_PATH . '/src/controllers/posts/CreatePostController.php';
require_once PROJECT_ROOT_PATH . '/src/controllers/posts/DeletePostController.php';
require_once PROJECT_ROOT_PATH . '/src/controllers/posts/DetailPostController.php';
require_once PROJECT_ROOT_PATH . '/src/controllers/posts/RetrievePostController.php';
require_once PROJECT_ROOT_PATH . '/src/controllers/posts/SearchPostController.php';
require_once PROJECT_ROOT_PATH . '/src/controllers/posts/UpdatePostController.php';
require_once PROJECT_ROOT_PATH . '/src/controllers/posts/LikePostController.php';

require_once PROJECT_ROOT_PATH . '/src/controllers/users/RetrieveUserController.php';
require_once PROJECT_ROOT_PATH . '/src/controllers/users/UpdateUserController.php';
require_once PROJECT_ROOT_PATH . '/src/controllers/users/DeleteUserController.php';
require_once PROJECT_ROOT_PATH . '/src/controllers/users/DetailUserController.php';

require_once PROJECT_ROOT_PATH . '/src/controllers/user-reports/AddUserReportController.php';
require_once PROJECT_ROOT_PATH . '/src/controllers/user-reports/DeleteUserReportController.php';
require_once PROJECT_ROOT_PATH . '/src/controllers/user-reports/GetUserReportController.php';
require_once PROJECT_ROOT_PATH . '/src/controllers/user-reports/UpdateStatusUserReportController.php';

require_once PROJECT_ROOT_PATH . '/src/controllers/auth/LoginController.php';
require_once PROJECT_ROOT_PATH . "/src/controllers/auth/LogoutController.php";

require_once PROJECT_ROOT_PATH . "/src/controllers/auth/RegisterController.php";

require_once PROJECT_ROOT_PATH . "/src/controllers/auth/ForgetPasswordController.php";

require_once PROJECT_ROOT_PATH . "/src/controllers/upload/FileUploadController.php";

$routeHandler = new APIRouter();

$routeHandler->addHandler('/api', CheckHealthController::getInstance(), []);

// $routeHandler->addHandler('/api/post', PostController::getInstance(), []);
$routeHandler->addHandler('/api/post/create', CreatePostController::getInstance(), []);
$routeHandler->addHandler('/api/post/read', RetrievePostController::getInstance(), []);
$routeHandler->addHandler('/api/post/search', SearchPostController::getInstance(), []);
$routeHandler->addHandler('/api/post/read/*', DetailPostController::getInstance(), []);
$routeHandler->addHandler('/api/post/update/*', UpdatePostController::getInstance(), []);
$routeHandler->addHandler('/api/post/delete/*', DeletePostController::getInstance(), []);
$routeHandler->addHandler('/api/post/like', LikePostController::getInstance(), []);

$routeHandler->addHandler('/api/user/read', RetrieveUserController::getInstance(), [CheckAdmin::getInstance()]);
$routeHandler->addHandler('/api/user/read/*', DetailUserController::getInstance(), []);
$routeHandler->addHandler('/api/user/update/*', UpdateUserController::getInstance(), []);
$routeHandler->addHandler('/api/user/delete/*', DeleteUserController::getInstance(), []);

$routeHandler->addHandler('/api/user_report/create', AddUserReportController::getInstance(), []);
$routeHandler->addHandler('/api/user_report/read', GetUserReportController::getInstance(), []);
$routeHandler->addHandler('/api/user_report/update', UpdateStatusUserReportController::getInstance(), []);
$routeHandler->addHandler('/api/user_report/delete', DeleteUserReportController::getInstance(), []);

// $routeHandler->addHandler('/api/post_report/create', CreatePostReportController::getInstance(), []);
// $routeHandler->addHandler('/api/post_report/read', ReadPostReportController::getInstance(), []);
// $routeHandler->addHandler('/api/post_report/update', UpdatePostReportController::getInstance(), []);
// $routeHandler->addHandler('/api/post_report/delete', DeletePostReportController::getInstance(), []);

$routeHandler->addHandler('/api/auth/login', LoginController::getInstance(), []);
$routeHandler->addHandler('/api/auth/register', RegisterController::getInstance(), []);
$routeHandler->addHandler('/api/auth/logout', LogoutController::getInstance(), []);

$routeHandler->addHandler('/api/auth/forget-password', ForgetPasswordController::getInstance(), []);

$routeHandler->addHandler('/api/upload', FileUploadController::getInstance (), []);

$routeHandler->run($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

?>