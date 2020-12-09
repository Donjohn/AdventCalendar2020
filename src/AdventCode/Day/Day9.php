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
            if (!$this->isSumOfPrevious($i, $lines)) {
                return $lines[$i];
            }
        }


        return 0;
    }


    /**
     * @param int $index
     * @param array $entries
     *
     * @return bool
     */
    private function isSumOfPrevious(int $index, array $entries): bool
    {
        $valueToFind = (int)$entries[$index];
        $values = array_splice($entries, $index-25, 25);
        sort($values);
        for($i=0; $i<25; $i++)
        {
            for($j=$i+1; $j<25; $j++)
            {
                if ((int)$values[$i]+(int)$values[$j] === $valueToFind) {
                    return true;
                }
            }
        }

        return false;

    }

}
