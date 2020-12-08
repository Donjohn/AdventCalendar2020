<?php


namespace App\AdventCode\Day;


/**
 * Trait Day1
 *
 * @package App\AdventCode\Day
 */
trait Day1
{
    /**
     * @return int
     */
    public function day1part1(): int
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
                    return $lines[$i]*$lines[$j];
                }
            }
            $j=$i;
        }

        return 0;
    }


    /**
     * @return int
     */
    public function day1part2(): int
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
                        return $lines[$i]*$lines[$j]*$lines[$k];
                    }
                }
                $k=$j;
            }
            $j=$i;
        }

        return 0;
    }
}
