<?php


namespace App\AdventCode\Day;


/**
 * Trait Day3
 *
 * @package App\AdventCode\Day
 */
trait Day3
{



    /**
     * @param array $lines
     * @param int   $right
     * @param int   $down
     *
     * @return int
     */
    private function getSmashedTrees(array $lines, int $right, int $down): int
    {
        $nbTrees = 0;
        $nbLines = count($lines)-1;
        $lineLenght = strlen($lines[0])-1;
        $lineCursor=0;
        $columnCursor=0;
        while ($lineCursor < $nbLines)
        {
            $columnCursor = ($columnCursor+$right) > $lineLenght ? (($columnCursor+$right) % $lineLenght)-1 : ($columnCursor+$right);
            $lineCursor = $down + $lineCursor;
            if ($lines[$lineCursor][$columnCursor] === '#')
            {
                $nbTrees++;
            }
        }

        return $nbTrees;
    }

    /**
     * @return int
     */
    public function day3part1(): int
    {
        $lines = $this->getFile('day3part1.txt');

        return $this->getSmashedTrees($lines, 3, 1);
    }

    /**
     * @return int
     */
    public function day3part2(): int
    {
        $lines = $this->getFile('day3part1.txt');

        return $this->getSmashedTrees($lines, 1, 1) * $this->getSmashedTrees($lines, 3, 1) * $this->getSmashedTrees($lines, 5, 1) * $this->getSmashedTrees($lines, 7, 1) * $this->getSmashedTrees($lines, 1, 2);
    }
}
