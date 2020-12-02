<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Day1Part2Command extends Command
{
    protected static $defaultName = 'Day1Part2';
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
        $path = $this->projectDir.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'Day1'.DIRECTORY_SEPARATOR.'Part2'.DIRECTORY_SEPARATOR.'input.txt';

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
        $k=2;
        for($i=0; $inputs[$i]+$inputs[$j]+$inputs[$k]<=2020 && $i < $nbInputs && $j < $nbInputs && $k < $nbInputs; $i++)
        {
            for($j=$i+1; $inputs[$i]+$inputs[$j]+$inputs[$k]<=2020 && $i < $nbInputs && $j < $nbInputs && $k < $nbInputs; $j++)
            {
                for($k=$j+1; $inputs[$i]+$inputs[$j]+$inputs[$k]<=2020 && $i < $nbInputs && $j < $nbInputs && $k < $nbInputs; $k++)
                {
                    if ($inputs[$i]+$inputs[$j]+$inputs[$k]===2020) {
                        $output->writeln($inputs[$i]*$inputs[$j]*$inputs[$k]);
                        return Command::SUCCESS;
                    }
                }
                $k=$j;
            }
            $j=$i;
        }



        return Command::FAILURE;
    }
}
