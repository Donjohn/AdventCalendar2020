<?php


namespace App\AdventCode\Day;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Trait Day4
 *
 * @package App\AdventCode\Day
 */
trait Day4
{
    /**
     * @param OutputInterface $output
     *
     * @return int
     */
    public function day4part1(OutputInterface $output)
    {
        $lines = file($this->projectDir.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.__FUNCTION__.'.txt',FILE_IGNORE_NEW_LINES);
        $nbValide = 0;
        $pattern = ['byr', 'iyr', 'eyr', 'hgt', 'hcl', 'ecl', 'pid'];
        $documentKey = [];

        $isValide = static function($documentKey) use ($pattern)
        {
            return count(array_diff($pattern, $documentKey))=== 0;
        };

        foreach ($lines as $line)
        {
            if ($line === '')
            {
                if ($isValide($documentKey)) {
                    $nbValide++;
                }
                $documentKey = [];
            } else {
                preg_match_all('/((?P<key>\w+):(?P<value>[\w\s#]\s?))/', $line, $match);
                foreach ($match['key'] as $key)
                {
                    $documentKey[] = $key;
                }
            }

        }

        if ($isValide($documentKey)) {
            $nbValide++;
        }

        $output->writeln($nbValide);
        return $nbValide> 0 ? Command::SUCCESS: Command::FAILURE;
    }
}
