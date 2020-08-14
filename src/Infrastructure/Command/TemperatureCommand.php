<?php

namespace PH\Infrastructure\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class TemperatureCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function configure()
    {

        $this
            ->setName('app:temperature')
            ->setDescription('Show the temperature.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("See the temperature");
        return 0;
    }
}