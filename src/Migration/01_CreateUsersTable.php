<?php

namespace SilexStarter\Migration;

use Doctrine\DBAL\Schema\Schema;
use Silex\Application;

class ProjectMigration
{
    public function getMigrationInfo()
    {
        return 'First migration message.';
    }

    public function schemaUp(Schema $schema)
    {
        //
    }

    public function schemaDown(Schema $schema)
    {
        //
    }

    public function appUp(Application $app)
    {
        //
    }

    public function appDown(Application $app)
    {
        //
    }
}