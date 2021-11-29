<?php

namespace PH\Application\Command;

use PH\Domain\Temperature\ApiAemet;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ClimatologicalValuesCommand extends Command
{
    private $apiAemet;

    public function __construct($name = null)
    {
        parent::__construct($name);
        $this->apiAemet = new ApiAemet();
    }

    protected function configure()
    {
        $this->setName('app:climatological-values')
            ->setDescription('Returns climatological values for given params')
            ->addArgument('start_date', InputArgument::REQUIRED, 'Start Date')
            ->addArgument('end_date', InputArgument::REQUIRED, 'End Date')
            ->addArgument('idema', InputArgument::REQUIRED, 'Meteorology station ID');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $start_date = $input->getArgument('start_date');
        $end_date = $input->getArgument('end_date');
        $idema = $input->getArgument('idema');

        $value = $this->apiAemet->getClimatologicalValueByDatesAndProvince($start_date, $end_date, $idema);

        $output->writeln($value);
    }
}
