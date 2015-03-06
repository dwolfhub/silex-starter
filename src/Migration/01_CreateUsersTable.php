<?php

namespace SilexStarter\Migration;

use Doctrine\DBAL\Schema\Schema;
use Silex\Application;

class CreateUsersTable
{
    public function getMigrationInfo()
    {
        return 'Create users table.';
    }

    public function schemaUp(Schema $schema)
    {
        $schema->createTable('users')
            ->addColumn('id', 'int', [
                'unsigned' => true,
                'autoincrement' => true
            ])
            ->addColumn('username', 'varchar', [
                'notnull' => true
            ])
            ->addColumn('created', 'timestamp', [
                'notnull' => true
            ]);
    }

    public function schemaDown(Schema $schema)
    {
        $schema->dropTable('users');
    }
}