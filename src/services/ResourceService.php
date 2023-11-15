<?php
class ResourceService extends BaseService {
    protected static $instance;

    protected $repository;

    private function __construct($repository) {
        $this->repository = $repository;
    }

    public static function getInstance() {
        if (!(isset(self::$instance))) {
            self::$instance = new static(
                ResourceRepository::getInstance(),
            );
        }

        return self::$instance;
    }

    public function getResourcesByPostId($post_id) {
        $resources = [];

        $resource_sqls = $this->repository->getAllByPostId($post_id);
        if ($resource_sqls) {
            foreach ($resource_sqls as $resource_sql) {
                $resource = new ResourceModel();
                $resource->constructFromArray($resource_sql);
                $resources[] = $resource;
            }
        }

        return $resources;
    }
}
?>