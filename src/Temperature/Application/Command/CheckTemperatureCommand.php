<?php

namespace PH\Temperature\Application\Command;

use PH\Temperature\Domain\Temperature;
use PH\Temperature\Domain\TemperatureNegativeException;
use PH\Temperature\Infrastructure\Repository\ColdThresholdRepository;
use PH\Temperature\Infrastructure\Repository\HotThresholdRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class CheckTemperatureCommand extends Command
{
    private HotThresholdRepository $hotThresholdRepository;
    private ColdThresholdRepository $coldThresholdRepository;

    public function __construct(string $name = null)
    {
        parent::__construct($name);

        $this->hotThresholdRepository = new HotThresholdRepository();
        $this->coldThresholdRepository = new ColdThresholdRepository();
    }

    protected function configure()
    {
        $this->setName('check-temperature')
            ->setDescription('Checks if a temperature is super hot or super cold')
            ->addArgument('measure', InputArgument::REQUIRED, 'Pass a measure.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws TemperatureNegativeException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $measure = $input->getArgument('measure');
        $temperature = Temperature::take($measure);

        if ($this->hotThresholdRepository->isSuperHot($temperature)) {
            $output->writeln('The temperature is super hot');
        } elseif ($this->coldThresholdRepository->isSuperCold($temperature)) {
            $output->writeln('The temperature is super cold');
        } else {
            $output->writeln("The temperature it's not super hot nor super cold");
        }

        return 0;
    }

}