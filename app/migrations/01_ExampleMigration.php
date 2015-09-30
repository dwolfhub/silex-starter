<?php

namespace Migration;

use \SilexStarter\Command\AbstractMigration;
use \Doctrine\DBAL\Schema\Schema;

class ExampleMigration extends AbstractMigration
{
    public function schemaUp(Schema $schema)
    {
        $usersTable = $schema->createTable('users');
        $usersTable->addColumn('id', 'integer', [
            'unsigned' => true,
            'autoincrement' => true,
        ]);
        $usersTable->addColumn('name', 'string');
        $usersTable->addColumn('email', 'string');
        $usersTable->addColumn('password', 'string');
        $usersTable->setPrimaryKey(['id']);
        $usersTable->addUniqueIndex(['name']);
    }

    public function getMigrationInfo()
    {
        return 'Added users table';
    }
}