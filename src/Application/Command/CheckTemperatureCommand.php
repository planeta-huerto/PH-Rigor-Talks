<?php

namespace PH\Application\Command;

use PH\Domain\Temperature\Temperature;
use Symfony\Component\Console\Command\Command;
use PH\Infrastructure\Services\ServicesContainer;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CheckTemperatureCommand extends Command
{
    private $servicesContainer;

    public function __construct($name = null)
    {
        parent::__construct($name);
        $this->servicesContainer = ServicesContainer::getInstance();
    }

    protected function configure()
    {
        $this->setName('app:check-temperature')
            ->setDescription('Returns if the temperature is super cold or super hot')
            ->addArgument('measure', InputArgument::REQUIRED, 'Temeprature\'s measure');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $measure = $input->getArgument('measure');
        $temperature = Temperature::take($measure);

        $hotThresholdRepository = $this->servicesContainer->get('hot.repository');
        $coldThresholdRepository = $this->servicesContainer->get('cold.repository');

        if ($coldThresholdRepository->isSuperCold($temperature)) {
            $output->writeln("The temperature is super cold");
        } else if ($hotThresholdRepository->isSuperHot($temperature)) {
            $output->writeln("The temperature is super hot");
        } else {
            $output->writeln("It's not super cold nor super hot");
        }
    }
}
