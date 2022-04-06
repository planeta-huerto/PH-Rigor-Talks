<?php

namespace PH\Temperature\Application\Command;

use PH\Temperature\Application\IsSuperHot;
use PH\Temperature\Domain\Temperature;
use PH\Temperature\Infrastructure\Repository\HotThreshold;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CheckHotTemperatureCommand extends Command
{

    protected static $defaultName = 'app:checkTemperature';

    public function __construct()
    {
        parent::__construct(null);
    }

    protected function configure(): void
    {
        $this
            ->addArgument('checkTemperature', InputArgument::REQUIRED, 'Check if the introduced temperature is SUPER HOT or SUPER COLD.');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'Calculating temperature',
            '============',
            '',
        ]);

        $entry = floatval($input->getArgument('temperature'));

        if (empty($entry)) {
            throw new \Exception('Missing parameter temperature');
            return Command::FAILURE;
        }

        $threshold = new HotThreshold();
        $temperature = Temperature::take($entry);
        $isSuperHot = new IsSuperHot($temperature, $threshold);

        if ($isSuperHot()) {
            $output->writeln("The temperature: $entry is SUPER HOT");
        } else {
            $output->writeln("The temperature: $entry is not SUPER HOT");
        }

        return Command::SUCCESS;
    }
}