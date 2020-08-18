<?php

namespace PH\Infrastructure\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use PH\Domain\APITemperature;

final class ApiAemetCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    public function configure()
    {
        $this
            ->setName("api:getTemperature")
            ->setDescription("Give the temperature of the actual day with the API Aemet")
            ->addArgument(
                "initial_date",
                InputArgument::OPTIONAL,
                "Data Format: YYYY-MM-DD"
            )
            ->addArgument(
                "end_date",
                InputArgument::OPTIONAL,
                "Data Format: YYYY-MM-DD"
            )
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $ini = $input->getArgument("initial_date");
        $end = $input->getArgument("end_date");
        $apiTemperature = new APITemperature();
        $text = $apiTemperature->readData($ini, $end);
        $output->writeln($text);
    }
}