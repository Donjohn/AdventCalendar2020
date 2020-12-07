<?php


namespace App\AdventCode\Day;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;

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
    private function factorDay3(array $lines, int $right, int $down)
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
     * @param OutputInterface $output
     *
     * @return int
     */
    public function day3part1(OutputInterface $output)
    {
        $lines = file($this->projectDir.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.__FUNCTION__.'.txt',FILE_IGNORE_NEW_LINES);

        $nbTrees = $this->factorDay3($lines, 3, 1);
        $output->write($nbTrees);
        return $nbTrees> 0 ? Command::SUCCESS: Command::FAILURE;
    }

    /**
     * @param OutputInterface $output
     *
     * @return int
     */
    public function day3part2(OutputInterface $output)
    {
        $lines = file($this->projectDir.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'day3part1.txt',FILE_IGNORE_NEW_LINES);

        $nbTrees = $this->factorDay3($lines, 1, 1) * $this->factorDay3($lines, 3, 1) * $this->factorDay3($lines, 5, 1) * $this->factorDay3($lines, 7, 1) * $this->factorDay3($lines, 1, 2);
        $output->write($nbTrees);
        return $nbTrees> 0 ? Command::SUCCESS: Command::FAILURE;
    }
}
