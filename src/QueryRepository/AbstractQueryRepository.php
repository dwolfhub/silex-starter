<?php

namespace SilexStarter\QueryRepository;

use Doctrine\DBAL\Connection;

abstract class AbstractQueryRepository
{
    /**
     * @var Connection
     */
    protected $conn;

    public function __construct(Connection $conn)
    {
        $this->conn = $conn;
    }

    /**
     * @return Connection
     */
    public function getConn()
    {
        if ($this->conn) {
            return $this->conn;
        }
    }

    /**
     * @param Connection $conn
     * @return $this
     */
    public function setConn(Connection $conn)
    {
        $this->conn = $conn;
        return $this;
    }
}