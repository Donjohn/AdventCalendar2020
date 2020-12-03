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

    private function getInputs(string $path, bool $toInt = false): array
    {
        $inputs=[];

        $fn = fopen($path, 'rb');
        while(! feof($fn))  {
            $number=fgets($fn);
            if ($number) {
                $inputs[] = $toInt ? (int)$number : $number;
            }
        }
        fclose($fn);

        return $inputs;
    }


    /**
     * @param OutputInterface $output
     *
     * @return int
     */
    public function day1part1(OutputInterface $output)
    {
        $inputs = $this->getInputs($this->projectDir.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.__FUNCTION__.'.txt', true);
        sort($inputs);
        $nbInputs = count($inputs);
        $j=1;
        for($i=0; $inputs[$i]+$inputs[$j]<=2020 && $i < $nbInputs && $j < $nbInputs; $i++)
        {
            for($j=$i+1; $inputs[$i]+$inputs[$j]<=2020 && $i < $nbInputs && $j < $nbInputs; $j++)
            {
                if ($inputs[$i]+$inputs[$j]===2020) {
                    $output->writeln($inputs[$i]*$inputs[$j]);
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
        $inputs = $this->getInputs($this->projectDir.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.__FUNCTION__.'.txt', true);
        sort($inputs);
        $nbInputs = count($inputs);
        $j=1;
        $k=2;
        for($i=0; $inputs[$i]+$inputs[$j]+$inputs[$k]<=2020 && $i < $nbInputs && $j < $nbInputs && $k < $nbInputs; $i++)
        {
            for($j=$i+1; $inputs[$i]+$inputs[$j]+$inputs[$k]<=2020 && $i < $nbInputs && $j < $nbInputs && $k < $nbInputs; $j++)
            {
                for($k=$j+1; $inputs[$i]+$inputs[$j]+$inputs[$k]<=2020 && $i < $nbInputs && $j < $nbInputs && $k < $nbInputs; $k++)
                {
                    if ($inputs[$i]+$inputs[$j]+$inputs[$k]===2020) {
                        $output->writeln($inputs[$i]*$inputs[$j]*$inputs[$k]);
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
        $inputs = $this->getInputs($this->projectDir.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.__FUNCTION__.'.txt');
        $valide=0;

        foreach ($inputs as $line)
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
        $inputs = $this->getInputs($this->projectDir.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.__FUNCTION__.'.txt');
        $valide=0;

        foreach ($inputs as $line)
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
