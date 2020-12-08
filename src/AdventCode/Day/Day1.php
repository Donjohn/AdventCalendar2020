<?php


namespace App\AdventCode\Day;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Trait Day1
 *
 * @package App\AdventCode\Day
 */
trait Day1
{
    /**
     * @param OutputInterface $output
     *
     * @return int
     */
    public function day1part1(OutputInterface $output): int
    {
        $lines = $this->getFile('day1part1.txt');
        sort($lines);
        $nbInputs = count($lines);
        $j=1;
        for($i=0; $lines[$i]+$lines[$j]<=2020 && $i < $nbInputs && $j < $nbInputs; $i++)
        {
            for($j=$i+1; $lines[$i]+$lines[$j]<=2020 && $i < $nbInputs && $j < $nbInputs; $j++)
            {
                if ($lines[$i]+$lines[$j]===2020) {
                    $output->write($lines[$i]*$lines[$j]);
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
    public function day1part2(OutputInterface $output): int
    {
        $lines = $this->getFile('day1part2.txt');
        sort($lines);
        $nbInputs = count($lines);
        $j=1;
        $k=2;
        for($i=0; $lines[$i]+$lines[$j]+$lines[$k]<=2020 && $i < $nbInputs && $j < $nbInputs && $k < $nbInputs; $i++)
        {
            for($j=$i+1; $lines[$i]+$lines[$j]+$lines[$k]<=2020 && $i < $nbInputs && $j < $nbInputs && $k < $nbInputs; $j++)
            {
                for($k=$j+1; $lines[$i]+$lines[$j]+$lines[$k]<=2020 && $i < $nbInputs && $j < $nbInputs && $k < $nbInputs; $k++)
                {
                    if ($lines[$i]+$lines[$j]+$lines[$k]===2020) {
                        $output->write($lines[$i]*$lines[$j]*$lines[$k]);
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
