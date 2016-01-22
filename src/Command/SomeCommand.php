<?php

namespace SilexStarter\Command;

use Knp\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class SomeCommand extends Command
{

    protected function configure()
    {
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

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('ok!');
    }
}