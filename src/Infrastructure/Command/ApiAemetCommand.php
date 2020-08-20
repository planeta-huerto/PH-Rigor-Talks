<?php

namespace PH\Infrastructure\Command;

use PH\Domain\ProvinceNotFoundException;
use PH\Domain\Temperature;
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
                InputArgument::REQUIRED,
                "Data Format: YYYY-MM-DD"
            )
            ->addArgument(
                "end_date",
                InputArgument::REQUIRED,
                "Data Format: YYYY-MM-DD"
            )
            ->addArgument(
                "province",
                InputArgument::REQUIRED,
                "Province which you want to know de temperature"
            )
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $ini = $input->getArgument("initial_date");
        $end = $input->getArgument("end_date");
        $province = $input->getArgument("province");
        $apiTemperature = new APITemperature();
        $url_data = $apiTemperature->get_url_with_the_data($ini, $end);
        $measure = $apiTemperature->get_average_temperature_from_province($url_data, strtoupper($province));
        $tempature = Temperature::take($measure);
        $output->writeln('The temperature in ' . $province . ' is ' . $tempature->measure());
    }
}