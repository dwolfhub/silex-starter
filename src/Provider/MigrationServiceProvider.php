<?php

namespace SilexStarter\Provider;

use Doctrine\DBAL\Migrations\Configuration\Configuration;
use Silex\Application;
use Silex\ServiceProviderInterface;
use Doctrine\DBAL\Migrations\Tools\Console\Command;
//use Symfony\Component\Console\Helper\QuestionHelper;

class MigrationServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
//        $helpers = ['dialog' => new QuestionHelper()];
//        if (isset($app['orm.em'])) {
//            $helpers['em'] = new EntityManagerHelper($app['orm.em']);
//        }
//
//        $helperSet = new HelperSet($helpers);
//        $app->setHelperSet($helperSet);

        $config = new Configuration($app['db']);
        $migrationDir = dirname(__DIR__) . '/' . $app['config']['migrations']['path'];

        $config->setMigrationsNamespace($app['config']['migrations']['namespace']);
        $config->setMigrationsDirectory($migrationDir);
        $config->registerMigrationsFromDirectory($migrationDir);
        $config->setName($app['config']['migrations']['name']);
        $config->setMigrationsTableName($app['config']['migrations']['table']);

        $commands = [
            new Command\DiffCommand(),
            new Command\ExecuteCommand(),
            new Command\GenerateCommand(),
            new Command\MigrateCommand(),
            new Command\StatusCommand(),
            new Command\VersionCommand(),
        ];
        foreach ($commands as $command) {
            $command->setMigrationConfiguration($config);
            $app['console']->add($command);
        }
    }

    public function boot(Application $app)
    {
    }
}