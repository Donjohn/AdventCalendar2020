<?php


namespace App\AdventCode\Day;


/**
 * Trait Day9
 *
 * @package App\AdventCode\Day
 */
trait Day9
{

    /**
     * @return int
     */
    public function day9part1(): int
    {
        $lines = $this->getFile('day9.txt');
        $max = count($lines);

        for($i=25; $i<($max-25); $i++)
        {
            if ($this->isSumOfPrevious($i, $lines) === null) {
                return $lines[$i];
            }
        }


        return 0;
    }


    /**
     * @param int $index
     * @param array $entries
     *
     * @return int|null
     */
    private function isSumOfPrevious(int $index, array $entries): ?int
    {
        $valueToFind = (int)$entries[$index];
        $values = array_splice($entries, $index-25, 25);
        sort($values);
        for($i=0; $i<25; $i++)
        {
            for($j=$i+1; $j<25; $j++)
            {
                if ($values[$i]+$values[$j] === $valueToFind) {
                    return $valueToFind;
                }
            }
        }

        return null;

    }

    /**
     * @return int
     */
    public function day9part2(): int
    {
        $value = $this->day9part1();
        $lines = $this->getFile('day9.txt');

        $start=0;
        $end=0;
        $removeStart=true;
        $pendingSum=0;

        while($pendingSum!==$value)
        {
            if ($pendingSum>$value)
            {
                if ($removeStart) {
                    $pendingSum-=$lines[$start++];
                } else {
                    $pendingSum-=$lines[--$end];
                }
                $removeStart=false;
            } else {
                $removeStart=true;
                $pendingSum+=$lines[$end++];
            }

        }

        $lines = array_splice($lines, $start, ($end-$start));

        return min($lines)+max($lines);
    }

}
