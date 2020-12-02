<?php


namespace App\AdventCode;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class AdventCode2020
 *
 * @package App\AdventCode
 */
class AdventCode2020
{

    /**
     * @var string
     */
    private string $projectDir;

    public function __construct(string $projectDir)
    {
        $this->projectDir = $projectDir;
    }

    private function getInputs(string $path): array
    {
        $inputs=[];

        $fn = fopen($path, 'rb');
        while(! feof($fn))  {
            $number=fgets($fn);
            if ($number) {
                $inputs[] = (int)$number;
            }
        }
        fclose($fn);

        return $inputs;
    }


    /**
     * @param OutputInterface $output
     *
     * @return int
     */
    public function day1part1(OutputInterface $output)
    {
        $inputs = $this->getInputs($this->projectDir.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'day1part1.txt');
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

    /**
     * @param OutputInterface $output
     *
     * @return int
     */
    public function day1part2(OutputInterface $output)
    {
        $inputs = $this->getInputs($this->projectDir.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'day1part2.txt');
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
