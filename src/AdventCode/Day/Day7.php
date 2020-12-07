<?php


namespace App\AdventCode\Day;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Trait Day7
 *
 * @package App\AdventCode\Day
 */
trait Day7
{
    /**
     * @param OutputInterface $output
     *
     * @return int
     */
    public function day7part1(OutputInterface $output)
    {
        $lines = file($this->projectDir.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.__FUNCTION__.'.txt',FILE_IGNORE_NEW_LINES);


        preg_match_all('/([a-z]+\s[a-z]+)\sbags\scontain\s.+(shiny\sgold+)\sbags/m', implode("\n", $lines), $matches);

        $goodBags = $matches[1];
        $value = 0;
        $cargo = [];

        foreach($lines as $line)
        {
            preg_match('/([a-z]+\s[a-z]+)\sbags\scontain\s(.*)/', $line, $bag);
            preg_match_all('/([a-z]+\s[a-z]+)\sbag/', $bag[2], $bags);
            $cargo[$bag[1]] = $bags[1];
        }

        foreach ($cargo as $bag => $bags)
        {
            $value = $this->validBag($bag, $cargo, $goodBags) ? $value+1 : $value;
        }

        $output->writeln($value);
        return $value> 0 ? Command::SUCCESS: Command::FAILURE;
    }

    /**
     * @param string $bag
     * @param array  $cargo
     * @param array  $goodBags
     *
     * @return bool
     */
    private function validBag(string $bag, array $cargo, array $goodBags)
    {
        if (in_array($bag, $goodBags, true)) {
            return true;
        }

        if (isset($cargo[$bag])) {
            foreach($cargo[$bag] as $newBag) {
                if($this->validBag($newBag, $cargo, $goodBags))
                {
                    return true;
                }
            }
        }

        return false;
    }


}
