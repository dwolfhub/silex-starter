<?php

namespace SilexStarter\QueryRepository;

class UserQueryRepository extends AbstractQueryRepository {

    public function getAll()
    {
        $query = $this->conn->createQueryBuilder()
            ->select('u.*')
            ->from('users', 'u')
            ->getSQL();
        return $this->conn->fetchAll($query);
    }
}