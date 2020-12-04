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
                preg_match_all('/((?P<key>\w+):(?P<value>[#\w0-9]+))+/', $line, $match);
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


    /**
     * @param OutputInterface $output
     *
     * @return int
     */
    public function day4part2(OutputInterface $output)
    {
        $lines = file($this->projectDir.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'day4part1.txt',FILE_IGNORE_NEW_LINES);
        $nbValide = 0;
        $pattern = [
            'byr' => static function ($value) {
                return (int) $value >= 1920 && (int) $value <= 2002;
            },
            'iyr' => static function($value) {
                return (int) $value >= 2010 && (int) $value <= 2020;
            },
            'eyr' =>  static function($value) {
                return (int) $value >= 2020 && (int) $value <= 2030;
            },
            'hgt' => static function($value) {
                return preg_match_all('/^(\d{2,3})(cm|in)$/', $value, $matches ) &&
                    (
                        ($matches[2][0]==='cm' && $matches[1][0]>=150 && $matches[1][0]<=193) ||
                        ($matches[2][0]==='in' && $matches[1][0]>=59 && $matches[1][0]<=76)
                    );
            },
            'hcl' => static function($value) {
                return preg_match('/^#[0-9a-f]{6}$/i', $value);
            },
            'ecl' => static function($value) {
                return preg_match('/^(amb|blu|brn|gry|grn|hzl|oth)$/i', $value);
            },
            'pid' => static function($value) {
                return strlen($value) === 9;
            }
        ];
        $document = [];


        $isValide = static function($document) use ($pattern)
        {
            if (count(array_diff_key($pattern, $document)) !== 0)
            {
                return false;
            }

            foreach ($document as $key => $value)
            {
                if ($key !== 'cid' && !$pattern[$key]($value)) {
                    return false;
                }
            }

            return true;
        };

        foreach ($lines as $line)
        {
            if ($line === '')
            {
                if ($isValide($document)) {
                    $nbValide++;
                }
                $document = [];
            } else {
                preg_match_all('/((?P<key>\w+):(?P<value>[#\w0-9]+))+/', $line, $match);
                foreach ($match['key'] as $index => $key)
                {
                    $document[$key] = $match['value'][$index];
                }
            }

        }

        if ($isValide($document)) {
            $nbValide++;
        }

        $output->writeln($nbValide);
        return $nbValide> 0 ? Command::SUCCESS: Command::FAILURE;
    }
}
