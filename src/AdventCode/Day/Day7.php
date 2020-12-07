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
        $lines = $this->getFile(__FUNCTION__.'.txt');


        preg_match_all('/(\w+\s\w+)\sbags\scontain\s.+(shiny\sgold+)\sbags/m', implode("\n", $lines), $matches);

        $goodBags = $matches[1];
        $value = 0;
        $cargo = [];

        foreach($lines as $line)
        {
            preg_match('/(\w+\s\w+)\sbags\scontain\s(.*)/', $line, $bag);
            preg_match_all('/(\w+\s\w+)\sbag/', $bag[2], $bags);
            $cargo[$bag[1]] = $bags[1];
        }

        foreach ($cargo as $bag => $bags)
        {
            $value += $this->validBag($bag, $cargo, $goodBags);
        }

        $output->write($value);
        return $value> 0 ? Command::SUCCESS: Command::FAILURE;
    }

    /**
     * @param string $bag
     * @param array  $cargo
     * @param array  $goodBags
     *
     * @return int
     */
    private function validBag(string $bag, array $cargo, array $goodBags)
    {
        if (in_array($bag, $goodBags, true)) {
            return 1;
        }

        if (isset($cargo[$bag])) {
            foreach($cargo[$bag] as $newBag) {
                if($this->validBag($newBag, $cargo, $goodBags))
                {
                    return 1;
                }
            }
        }

        return 0;
    }

    /**
     * @param OutputInterface $output
     *
     * @return int
     */
    public function day7part2(OutputInterface $output)
    {
        $lines = $this->getFile('day7part1.txt');


        $value = 0;
        $cargo = [];

        foreach($lines as $line)
        {
            preg_match('/(\w+\s\w+)\sbags\scontain\s(.*)/', $line, $bag);
            preg_match_all('/((?P<number>\d+)\s(?P<bag>\w+\s\w+))\sbag/', $bag[2], $bags);
            $cargo[$bag[1]] = array_combine($bags['bag'], $bags['number']);
        }

        foreach ($cargo['shiny gold'] as $bag => $number)
        {
            $value+= $number + ($number*($this->countBag($bag, $cargo)));
        }

        $output->write($value);
        return $value> 0 ? Command::SUCCESS: Command::FAILURE;
    }

    /**
     * @param string $bag
     * @param array  $cargo
     *
     * @return int
     */
    private function countBag(string $bag, array $cargo)
    {
        if (count($cargo[$bag])===0)
        {
            return 0;
        }

        $value = 0;
        foreach($cargo[$bag] as $newBag => $number) {
            $value+= $number + ($number*($this->countBag($newBag, $cargo)));
        }
        return $value;

    }


}
