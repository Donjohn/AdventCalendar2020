<?php


namespace App\AdventCode\Day;


/**
 * Trait Day2
 *
 * @package App\AdventCode\Day
 */
trait Day2
{
    /**
     * @return int
     */
    public function day2part1(): int
    {
        $lines = $this->getFile('day2part1.txt');
        $valide=0;

        foreach ($lines as $line)
        {
            if (preg_match_all('/(?P<min>\d+)-(?P<max>\d+)\s(?P<letter>\w):\s(?P<password>\w+)/', $line, $matches))
            {
                $nbfound = preg_match_all('/'.$matches['letter'][0].'/', $matches['password'][0]);
                if ($nbfound >= (int) $matches['min'][0] && $nbfound <= (int) $matches['max'][0])
                {
                    $valide++;
                }
            }

        }

        return $valide;
    }

    /**
     * @return int
     */
    public function day2part2(): int
    {
        $lines = $this->getFile('day2part2.txt');
        $valide=0;

        foreach ($lines as $line)
        {
            if (preg_match_all('/(?P<firstPos>\d+)-(?P<secondPos>\d+)\s(?P<letter>\w):\s(?P<password>\w+)/', $line, $matches))
            {
                $firstPos = (int)$matches['firstPos'][0]-1;
                $secondPos = (int)$matches['secondPos'][0]-1;
                $letter =  $matches['letter'][0];
                if (
                    isset($matches['password'][0][$firstPos], $matches['password'][0][$secondPos]) &&
                    (
                        ($matches['password'][0][$firstPos] === $letter && $matches['password'][0][$secondPos] !== $letter) ||
                        ($matches['password'][0][$firstPos] !== $letter && $matches['password'][0][$secondPos] === $letter)
                    )
                )
                {
                    $valide++;
                }
            }

        }

        return $valide;
    }

}
