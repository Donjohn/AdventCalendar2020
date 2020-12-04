<?php


namespace App\AdventCode;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class AdventCode2020
 *
 * @package App\AdventCode
 */
class AdventCode2020
{

    /**
     * @var string
     */
    private string $projectDir;

    public function __construct(string $projectDir)
    {
        $this->projectDir = $projectDir;
    }


    /**
     * @param OutputInterface $output
     *
     * @return int
     */
    public function day1part1(OutputInterface $output)
    {
        $lines = file($this->projectDir.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.__FUNCTION__.'.txt',FILE_IGNORE_NEW_LINES);
        sort($lines);
        $nbInputs = count($lines);
        $j=1;
        for($i=0; $lines[$i]+$lines[$j]<=2020 && $i < $nbInputs && $j < $nbInputs; $i++)
        {
            for($j=$i+1; $lines[$i]+$lines[$j]<=2020 && $i < $nbInputs && $j < $nbInputs; $j++)
            {
                if ($lines[$i]+$lines[$j]===2020) {
                    $output->writeln($lines[$i]*$lines[$j]);
                    return Command::SUCCESS;
                }
            }
            $j=$i;
        }

        return Command::FAILURE;
    }

    /**
     * @param OutputInterface $output
     *
     * @return int
     */
    public function day1part2(OutputInterface $output)
    {
        $lines = file($this->projectDir.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.__FUNCTION__.'.txt',FILE_IGNORE_NEW_LINES);
        sort($lines);
        $nbInputs = count($lines);
        $j=1;
        $k=2;
        for($i=0; $lines[$i]+$lines[$j]+$lines[$k]<=2020 && $i < $nbInputs && $j < $nbInputs && $k < $nbInputs; $i++)
        {
            for($j=$i+1; $lines[$i]+$lines[$j]+$lines[$k]<=2020 && $i < $nbInputs && $j < $nbInputs && $k < $nbInputs; $j++)
            {
                for($k=$j+1; $lines[$i]+$lines[$j]+$lines[$k]<=2020 && $i < $nbInputs && $j < $nbInputs && $k < $nbInputs; $k++)
                {
                    if ($lines[$i]+$lines[$j]+$lines[$k]===2020) {
                        $output->writeln($lines[$i]*$lines[$j]*$lines[$k]);
                        return Command::SUCCESS;
                    }
                }
                $k=$j;
            }
            $j=$i;
        }



        return Command::FAILURE;
    }

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
        $output->writeln($nbTrees);
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
        $output->writeln($nbTrees);
        return $nbTrees> 0 ? Command::SUCCESS: Command::FAILURE;
    }

    /**
     * @param OutputInterface $output
     *
     * @return int
     */
    public function day4part1(OutputInterface $output)
    {
        $lines = file($this->projectDir.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.__FUNCTION__.'.txt',FILE_IGNORE_NEW_LINES);
        $nbValide = 0;
        $pattern = ['byr', 'iyr', 'eyr', 'hgt', 'hcl', 'ecl', 'pid', 'cid'];
        $documentKey = [];

        $isValide = static function($documentKey) use ($pattern, $output)
        {
            $missing = array_diff($pattern, $documentKey);
            if (($indexCid = array_search('cid', $missing)) !== false){
                unset($missing[$indexCid]);
            }

            return count($missing) === 0;
        };

        foreach ($lines as $nb => $line)
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

