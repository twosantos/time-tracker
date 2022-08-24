<?php 
// src/Command/CreateUserCommand.php
namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use App\Repository\RegistryRepository;
use App\Entity\Registry;
use \DateTime;

class RegistryCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:create-user';
    private RegistryRepository $registryRepository;

    public function __construct(RegistryRepository $registryRepository) {
        parent::__construct();
        $this->registryRepository = $registryRepository; 
    }

    protected function configure(): void
    {
        $this
            ->addArgument('name', InputArgument::REQUIRED, 'Name of the registry')
            ->addArgument('startTime', InputArgument::REQUIRED, 'Timestamp of start of the registry')
            ->addArgument('endTime', InputArgument::REQUIRED, 'Timestamp of end of the registry')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $text = 'Hi '.$input->getArgument('name');
        $output->writeln([
            'Registry command',
            '============',
            '',
        ]);

        $startDate = (new DateTime())->setTimestamp($input->getArgument('name'));
        $endDate = (new DateTime())->setTimestamp($input->getArgument('name'));
        $totalTime = $endDate->getTimestamp() - $startDate->getTimestamp();
        $registry = new Registry('', input->getArgument('name'), $startDate, $endDate, $totalTime);

        $this->registryRepository->add($registry, true);
        $output->writeln([
            'Data stored correctly',
        ]);

        return Command::SUCCESS;
    }
}