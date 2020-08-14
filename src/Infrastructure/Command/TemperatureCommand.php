<?php

namespace PH\Infrastructure\Command;

use PH\Infrastructure\ServiceContainer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use PH\Domain\Temperature;

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
            ->setDescription('It tells if the temperature is cold or hot.')
            ->addArgument(
                'measure',
                InputArgument::OPTIONAL,
                'Tell the measure of the temperature'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $measure = $input->getArgument('measure');
        $temperature = Temperature::take($measure);
        if($temperature->isSuperCold(ServiceContainer::instance()['in_memory_threshold'])){
            $text = "The temperature " . $temperature->measure() . " is super cold";
            $output->writeln($text);
        }
        else{
            $text = "The temperature " . $temperature->measure() . " is super hot";
            $output->writeln($text);
        }
        return 0;
    }
}