<?php


namespace App\AdventCode\Day;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Trait Day6
 *
 * @package App\AdventCode\Day
 */
trait Day6
{
    /**
     * @param OutputInterface $output
     *
     * @return int
     */
    public function day6part1(OutputInterface $output)
    {
        $lines = file($this->projectDir.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.__FUNCTION__.'.txt',FILE_IGNORE_NEW_LINES);


        $answers = [];
        $value = 0;
        foreach ($lines as $line) {

            if ($line === '')
            {
                $value+=count($answers);
                $answers = [];
            } else {
                $answer = array_flip(str_split($line));

                $answers = array_merge($answers,$answer);
            }

        }

        $value+=count($answers);

        $output->writeln($value);
        return $value> 0 ? Command::SUCCESS: Command::FAILURE;
    }

    /**
     * @param OutputInterface $output
     *
     * @return int
     */
    public function day6part2(OutputInterface $output)
    {
        $lines = file($this->projectDir.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'day6part1.txt',FILE_IGNORE_NEW_LINES);


        $newGroup = true;
        $value = 0;
        foreach ($lines as $line) {

            if ($line === '')
            {
                $value+=count($answers);
                $newGroup = true;
            } else {
                $answer = array_flip(str_split($line));

                $answers = $newGroup ? $answer : array_intersect_key($answers, $answer);
                $newGroup = false;
            }

        }

        $value+=count($answers);

        $output->writeln($value);
        return $value> 0 ? Command::SUCCESS: Command::FAILURE;
    }


}
