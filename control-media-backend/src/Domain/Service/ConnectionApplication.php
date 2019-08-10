<?php


namespace App\Domain\Service;


use App\Domain\Contract\Application\ConnectionApplicationInterface;

class ConnectionApplication implements ConnectionApplicationInterface
{
    private $connection;

    /**
     * ConnectionApplication constructor.
     * @param $connection
     */
    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function beginTransaction()
    {
        $this->connection->beginTransaction();
    }

    public function commit()
    {
        $this->connection->commit();
    }

    public function rollback()
    {
        $this->connection->rollback();
    }
}