<?php

namespace OpsWay\Migration\Reader\Db;

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;
use OpsWay\Migration\Reader\ReaderInterface;

class Product implements ReaderInterface
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $connection;
    protected $stmt;

    public function __construct(array $connectionParams)
    {
        $this->connection = DriverManager::getConnection($connectionParams, new Configuration());
    }

    /**
     * @return array|null
     */
    public function read()
    {
        if (is_null($this->stmt)) {
            $this->stmt = $this->connection->query("SELECT * FROM products");
        }
        return $this->stmt->fetch();
    }
}
