<?php

namespace App\Command;

use App\AdventCode\AdventCode2020;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class AdventCodeCommand
 *
 * @package App\Command
 */
class AdventCodeCommand extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'advent-code:2020';

    /**
     * @var AdventCode2020
     */
    private AdventCode2020 $adventCode2020;

    /**
     * Day1Part1Command constructor.
     *
     * @param AdventCode2020 $adventCode2020
     */
    public function __construct(AdventCode2020 $adventCode2020)
    {
        $this->adventCode2020 = $adventCode2020;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('day', InputArgument::REQUIRED, 'Day')
            ->addArgument('part', InputArgument::REQUIRED, 'Part')
        ;
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $functionName = 'day'.$input->getArgument('day').'part'.$input->getArgument('part');
        if (method_exists($this->adventCode2020, $functionName))
        {
            $startTime = microtime(true);
            $return = $this->adventCode2020->{'day'.$input->getArgument('day').'part'.$input->getArgument('part')}($output);
            $output->writeln((microtime(true)-$startTime).' ms');
            return $return;

        }
        $output->writeln(sprintf('Erreur : you did not write a solution for Day%s Part%s', $input->getArgument('day'), $input->getArgument('part')));
        return Command::FAILURE;
    }
}
