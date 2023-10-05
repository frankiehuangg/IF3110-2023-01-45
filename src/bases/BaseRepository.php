<?php

require_once PROJECT_ROOT_PATH . '/src/db/PDOInstance.php';

abstract class BaseRepository {
    protected static $instance;
    protected $pdo;
    protected $tableName = '';

    protected function __construct() {
        $this->pdo = PDOInstance::getInstance()->getPDO();
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    public function getPDO() {
        return $this->pdo;
    }

    public function getAll() {
        $sql = "SELECT * FROM ' $this->tableName";
        return $this->pdo->query($sql);
    }

    public function countRow($where = []) {
        $sql = "SELECT COUNT(*) FROM $this->tableName";

        $WHERE_CASE_EXIST = (count($where) > 0);
        if ($WHERE_CASE_EXIST) {
            $sql = $sql . " WHERE ";

            $sql = $sql . implode(" AND ", array_map(function($key, $val) {
                $LIKE_CASE_EXIST = ($val[0] === 1);
                if ($LIKE_CASE_EXIST) {
                    return "$key LIKE :$key";
                }

                return "$key = :$key";
            }, array_keys($where), array_values($where)));
        }

        $stmt = $this->pdo->prepare($sql);
        foreach ($where as $key => $val) {
            $VALUE = htmlspecialchars($val[1]);
            $TYPE  = htmlspecialchars($val[2]);

            $LIKE_CASE_EXIST = ($val[0] === 1);
            if ($LIKE_CASE_EXIST) {
                $stmt->bindValue(":$key", "%$VALUE%", $TYPE);
            } else {
                $stmt->bindValue(":$key", $VALUE, $TYPE);
            }
        }

        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function findAll(
        $where    = [],
        $orderBy  = '',
        $sortRes  = 0,
        $pageNo   = null,
        $pageSize = null
    ) {
        $sql = "SELECT * FROM $this->tableName";

        $WHERE_CASE_EXIST = (count($where) > 0);
        if ($WHERE_CASE_EXIST) {
            $sql = $sql . " WHERE ";
            $sql = $sql . implode(' AND ', array_map(function($key, $val) {
                $LIKE_CASE_EXIST = ($val[0] === 1);
                if ($LIKE_CASE_EXIST) {
                    return "$key LIKE :$key";
                }

                return "$key = :$key";
            }, array_keys($where), array_values($where)));
        }

        $ORDER_BY_CASE_EXIST = ($orderBy !== '');
        if ($ORDER_BY_CASE_EXIST) {
            $ORDER_BY = htmlspecialchars($orderBy);

            $sql = $sql . " ORDER BY $ORDER_BY";
        }

        $SORT_DESC_CASE = ($sortRes === 1);
        $SORT_ASCE_CASE = ($sortRes === 2);
        if ($SORT_DESC_CASE) {
            $sql = $sql . ' DESC ';
        } else if ($SORT_ASCE_CASE) {
            $sql = $sql . ' ASC ';
        }

        $stmt = $this->pdo->prepare($sql);
        foreach ($where as $key => $val) {
            $VALUE = htmlspecialchars($val[1]);
            $TYPE  = htmlspecialchars($val[2]);

            # $stmt->bindValue(':$key', $VALUE, $TYPE);

            $LIKE_CASE_EXIST = ($val[0] === 1);
            if ($LIKE_CASE_EXIST) {
                $VALUE = "%$VALUE$";
                $stmt->bindValue(':' . $key, $VALUE, $TYPE);
            } else {
                $stmt->bindValue(':' . $key, $VALUE, $TYPE);
            }
        }

        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findOne($params) {
        $sql = "SELECT * FROM $this->tableName WHERE";

        $i = 0;
        foreach ($params as $key => $val) {
            $sql = $sql . " $key = :$key";

            if ($i < count($params) - 1) {
                $sql = $sql . " AND";
            }

            $i++;
        }

        $stmt = $this->pdo->prepare($sql);
        foreach ($params as $key => $val) {
            $VALUE = htmlspecialchars($val[0]);
            $TYPE  = htmlspecialchars($val[1]);

            $stmt->bindValue(":$key", $VALUE, $TYPE);
        }

        $stmt->execute();
        return $stmt->fetch();
    }

    public function insert($model, $params) {
        $sql = "INSERT INTO $this->tableName (";

        $i = 0;
        foreach ($params as $key => $val) {
            $sql = $sql . "$key";

            if ($i < count($params) - 1) {
                $sql = $sql . ", ";
            }

            $i++;
        }

        $sql = $sql . ') VALUES (';
        $i = 0;
        foreach ($params as $key => $val) {
            $sql = $sql . ":$key";

            if ($i < count($params) - 1) {
                $sql = $sql . ", ";
            }

            $i++;
        }

        $sql = $sql . ')';

        $stmt = $this->pdo->prepare($sql);
        foreach ($params as $key => $val) {
            $VALUE = $model->get(htmlspecialchars($key));
            $TYPE  = htmlspecialchars($val);

            $stmt->bindValue(":$key", $VALUE, $TYPE);
        }

        $stmt->execute();
        return $this->pdo->lastInsertId();
    }

    public function update($model, $params) {
        $sql = "UPDATE $this->tableName SET ";

        $i = 0;
        foreach ($params as $key => $val) {
            $sql = "$key = :$key";

            if ($i < count($params) - 1) {
                $sql = $sql . '. ';
            }

            $i++;
        }

        $primaryKey = $model->get('_primary_key');
        $sql = $sql . " WHERE $primaryKey = :primaryKey";

        $stmt = $this->pdo->prepare($sql);
        foreach ($params as $key => $val) {
            $VALUE = htmlspecialchars($model->get($key));
            $TYPE  = $val;
            $stmt->bindValue(":$key", $VALUE, $TYPE);
        }
        $stmt->bindValue(":primaryKey", $model->get($primary_key), PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->rowCount();
    }

    public function delete($model) {
        $primaryKey = $model->get('_primary_key');

        $sql = "DELETE FROM $this->tableName WHERE $primaryKey = :primaryKey";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':primaryKey', $model->get(htmlspecialchars($primaryKey)), PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount();
    }

    public function getNLastRow($n) {
        $sql = "SELECT COUNT(*) FROM $this->tableName";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $count = $stmt->fetchColumn();

        if ($count < $n) {
            $n = $count;
        }

        $offset = $count - $n;

        $sql = "SELECT * FROM $this->tableName LIMIT :limit OFFSET :offset";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':limit', $n, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        $params = $stmt->fetchAll();

        return $params;
    }
}

?>
