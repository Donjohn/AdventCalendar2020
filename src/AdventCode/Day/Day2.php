<?php


namespace App\AdventCode\Day;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Trait Day2
 *
 * @package App\AdventCode\Day
 */
trait Day2
{
    /**
     * @param OutputInterface $output
     *
     * @return int
     */
    public function day2part1(OutputInterface $output)
    {
        $lines = file($this->projectDir.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.__FUNCTION__.'.txt',FILE_IGNORE_NEW_LINES);
        $valide=0;

        foreach ($lines as $line)
        {
            if (preg_match_all('/(?P<min>\d+)-(?P<max>\d+) (?P<letter>\w): (?P<password>\w+)/', $line, $matches))
            {
                $nbfound = preg_match_all('/'.$matches['letter'][0].'/', $matches['password'][0]);
                if ($nbfound >= (int) $matches['min'][0] && $nbfound <= (int) $matches['max'][0])
                {
                    $valide++;
                }
            }

        }

        $output->writeln($valide);
        return $valide> 0 ? Command::SUCCESS: Command::FAILURE;
    }

    /**
     * @param OutputInterface $output
     *
     * @return int
     */
    public function day2part2(OutputInterface $output)
    {
        $lines = file($this->projectDir.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.__FUNCTION__.'.txt',FILE_IGNORE_NEW_LINES);
        $valide=0;

        foreach ($lines as $line)
        {
            if (preg_match_all('/(?P<firstPos>\d+)-(?P<secondPos>\d+) (?P<letter>\w): (?P<password>\w+)/', $line, $matches))
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

        $output->writeln($valide);
        return $valide> 0 ? Command::SUCCESS: Command::FAILURE;
    }

}
