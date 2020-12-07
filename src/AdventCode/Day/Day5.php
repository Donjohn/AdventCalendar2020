<?php


namespace App\AdventCode\Day;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Trait Day4
 *
 * @package App\AdventCode\Day
 */
trait Day5
{
    /**
     * @param OutputInterface $output
     *
     * @return int
     */
    public function day5part1(OutputInterface $output)
    {
        $lines = file($this->projectDir.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.__FUNCTION__.'.txt',FILE_IGNORE_NEW_LINES);


        $value = 0;
        foreach ($lines as $line) {

            $startingRow = 0;
            $endingRow = 127;
            $nbRow = 128;
            $startingColumn = 0;
            $endingColumn = 7;
            $nbColumn = 8;

            $i = 0;
            while ($i < 7) {
                $nbRow /= 2;
                if ($line[$i] === 'B')
                {
                    $startingRow += $nbRow;
                } elseif ($line[$i] === 'F'){
                    $endingRow -= $nbRow;
                }
                $i++;
            }
            $row = $startingRow < $endingRow ? $startingRow : $endingRow;

            while ($i < 10) {
                $nbColumn /= 2;
                if ($line[$i] === 'R')
                {
                    $startingColumn += $nbColumn;
                } elseif ($line[$i] === 'L'){
                    $endingColumn *= $nbColumn;
                }
                $i++;
            }

            $column = $startingColumn < $endingColumn ? $startingColumn : $endingColumn;

            $calc = $row*8 + $column;
            $value = $calc > $value ? $calc : $value;
        }

        $output->writeln($value);
        return $value> 0 ? Command::SUCCESS: Command::FAILURE;
    }



}
