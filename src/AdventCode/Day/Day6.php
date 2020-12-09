<?php


namespace App\AdventCode\Day;


/**
 * Trait Day6
 *
 * @package App\AdventCode\Day
 */
trait Day6
{
    /**
     * @return int
     */
    public function day6part1(): int
    {
        $lines = $this->getFile('day6.txt');


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

        return $value;
    }

    /**
     * @return int
     */
    public function day6part2(): int
    {
        $lines = $this->getFile('day6.txt');


        $newGroup = true;
        $value = 0;
        $answers=[];
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

        return $value;
    }


}
