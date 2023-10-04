<?php

require_once PROJECT_ROOT_PATH . '/src/bases/BaseResponse.php';
require_once PROJECT_ROOT_PATH . '/src/bases/BaseController.php';
require_once PROJECT_ROOT_PATH . '/src/exceptions/BadRequestException.php';
require_once PROJECT_ROOT_PATH . '/src/exceptions/MethodNotAllowedException.php';

class APIRouter {
    private $pathHandler;

    public function addHandler($path, $handler, $middlewares) {
        $this->pathHandler[$path] = [$handler, $middlewares];
    }

    public function run($path, $method) {
        try {
            $pathWithoutQuery = explode('?', $path)[0];
            $this->routing($pathWithoutQuery, $method);
        } catch (BadRequestException $e) {
            header('HTTP/1.0 400 Bad Request');

            echo (new BaseResponse(
                false,
                null,
                $e->getMessage(),
                400
            ))->toJSON();

        } catch (MethodNotAllowedException $e) {
            header('HTTP/1.0 405 Method Not Allowed');

            echo (new BaseResponse(
                false,
                null,
                $e->getMessage(),
                405
            ))->toJSON();

        } catch (Exception $e) {
            header('HTTP/1.0 500 Internal Server Error');

            echo (new BaseResponse(
                false,
                null,
                $e->getMessage(),
                500
            ))->toJSON();

        }
    }

    private function routing($path, $method) {
        foreach($this->pathHandler as $key => $val) {

            $match = $this->isMatch($path, $key);

            if ($match[0]) {
                $middlewares = $val[1];

                $isPass = true;
                foreach ($middlewares as $middleware) {
                    $isPass = $middleware($path, $method);
                    if (!$isPass) {
                        break;
                    }
                }

                if ($isPass) {
                    echo $val[0]->handle($method, $match[1]);
                    exit();
                }
            }
        }

        throw new MethodNotAllowedException('Method not allowed');
    }

    public function isMatch($path, $key_handler) {
        $path = explode('/', $path);
        $key_handler = explode('/', $key_handler);

        if (count($path) !== count($key_handler)) {
            return [false, []];
        }

        $url_params = [];

        for ($i = 0; $i < count($path); $i++) {
            if ($path[$i] !== $key_handler[$i] && $key_handler[$i] !== '*') {
                return [false, []];
            }

            if ($key_handler[$i] === '*') {
                $url_params[] = $path[$i];
            }
        }

        return [true, $url_params];
    }
};

?>
