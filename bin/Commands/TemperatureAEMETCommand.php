<?php
declare(strict_types=1);

namespace PH\Bin\Commands;

use PH\Application\QueryTempService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class TemperatureAEMETCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:aemet-tmp';

    private QueryTempService $service;

    public function __construct(QueryTempService $service)
    {
        $this->service = $service;
        parent::__construct(null);
    }

    protected function configure()
    {
        $this
            // configure an argument
            ->setDescription('Obtiene la temperatura de la estacion AEMET')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $temperature = call_user_func($this->service);
        try {
            $tempValue = $temperature->measure();
            $output->writeln($tempValue);

            return 0;
        } catch (\Exception $exception) {
            $output->writeln($exception->getMessage());

            return 1;
        }
    }
}