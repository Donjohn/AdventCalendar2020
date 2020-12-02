<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Day1Part1Command extends Command
{
    protected static $defaultName = 'Day1Part1';
    /**
     * @var string
     */
    private $projectDir;

    public function __construct(string $projectDir)
    {

        $this->projectDir = $projectDir;
        parent::__construct();
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $path = $this->projectDir.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'Day1'.DIRECTORY_SEPARATOR.'Part1'.DIRECTORY_SEPARATOR.'input.txt';

        $inputs=[];

        $fn = fopen($path, 'rb');
        while(! feof($fn))  {
            $number=fgets($fn);
            if ($number) {
                $inputs[] = (int)$number;
            }
        }
        fclose($fn);

        sort($inputs);
        $nbInputs = count($inputs);
        $j=1;
        for($i=0; $inputs[$i]+$inputs[$j]<=2020 && $i < $nbInputs && $j < $nbInputs; $i++)
        {
            for($j=$i+1; $inputs[$i]+$inputs[$j]<=2020 && $i < $nbInputs && $j < $nbInputs; $j++)
            {
                if ($inputs[$i]+$inputs[$j]===2020) {
                    $output->writeln($inputs[$i]*$inputs[$j]);
                    return Command::SUCCESS;
                }
            }
            $j=$i;
        }



        return Command::FAILURE;
    }
}
