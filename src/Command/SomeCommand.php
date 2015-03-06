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

class SomeCommand extends Command {

    protected function configure() {
        $this->setName('some:command')
            ->setDescription('Some command.')
            ->addArgument(
                'id',
                InputArgument::OPTIONAL,
                'Some command with an id.'
            )
            ->addOption(
                'debug',
                null,
                InputOption::VALUE_NONE,
                'Run in debug mode.'
            );
    }
}