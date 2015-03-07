<?php

namespace SilexStarter\QueryRepository;

class UserQueryRepository extends AbstractQueryRepository {


    /**
     * @return array|boolean
     */
    public function getAll()
    {
        $query = $this->conn->createQueryBuilder()
            ->select('u.*')
            ->from('users', 'u')
            ->getSQL();
        return $this->conn->fetchAll($query);
    }

    /**
     * @param $token int
     * @return array|boolean
     */
    public function getUserByToken($token)
    {
        $query = $this->conn->createQueryBuilder()
            ->select('u.id, u.email, t.token, u.created')
            ->from('users', 'u')
            ->innerJoin('u', 'tokens t', '', 't.id = u.id')
            ->where('t.token = :token')
            ->setParameter('token', $token);
        return $this->conn->fetchAssoc($query->getSQL(), $query->getParameters());
    }
}