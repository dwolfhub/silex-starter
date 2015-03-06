<?php
/**
 * Created by PhpStorm.
 * User: danielwolf
 * Date: 3/5/15
 * Time: 7:08 PM
 */

namespace SilexStarter\Command;


use Knp\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class Migrate extends Command {

    protected function configure() {
        $this
            ->setName('migrate:up')
            ->setDescription('Update your database.')
            ->addArgument(
                'userId',
                InputArgument::OPTIONAL,
                'Import for a specific user'
            )
            ->addOption(
                'debug',
                null,
                InputOption::VALUE_NONE,
                'If set, the task will run in debug mode'
            )
        ; // nice, new line
    }
}