<?php
declare(strict_types=1);

namespace PH\Bin\Commands;

use PH\Application\IsSuperHot;
use PH\Domain\Temperature;
use PH\Infrastructure\HotThreshold;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class SuperHotCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:is-super-hot';

    public function __construct()
    {
        parent::__construct(null);
    }

    protected function configure(): void
    {
        $this
            // configure an argument
            ->addArgument('temperature', InputArgument::REQUIRED, 'Temperatura introducida.')
            // ...
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'Calcular temperatura',
            '============',
            '',
        ]);

        $entrada = floatval($input->getArgument('temperature'));

        $threshold = new HotThreshold();
        $temperature = Temperature::take($entrada);
        $isSuperHot = new IsSuperHot($temperature, $threshold);

        if($isSuperHot()){
            $output->writeln("La temperatura: $entrada es SUPER HOT");
        } else {
            $output->writeln("La temperatura: $entrada NO es SUPER HOT");
        }

        return Command::SUCCESS;
    }
}