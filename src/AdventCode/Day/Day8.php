<?php


namespace App\AdventCode\Day;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Trait Day8
 *
 * @package App\AdventCode\Day
 */
trait Day8
{

    private int $cursor = 0;
    private int $value = 0;
    /**
     * @param OutputInterface $output
     *
     * @return int
     */
    public function day8part1(OutputInterface $output)
    {
        preg_match_all(
            '/(?P<command>jmp|acc|nop)\s(?P<action>[+|\-]\d+)/m',
            $this->getFile(__FUNCTION__.'.txt', true),
            $matches
        );

        $this->startConsole($matches['command'], $matches['action']);

        $output->write($this->value);
        return $this->value > 0 ? Command::SUCCESS : Command::FAILURE;
    }

    /**
     * @param $action
     */
    private function jmp($action)
    {
        if ($action[0] === '-') {
            $this->cursor -= (int)substr($action, 1);
        } else {
            $this->cursor += (int)substr($action, 1);
        }
    }

    /**
     * @param $action
     */
    private function acc($action)
    {
        if ($action[0] === '-') {
            $this->value -= (int)substr($action, 1);
        } else {
            $this->value += (int)substr($action, 1);
        }
        $this->cursor++;
    }

    /**
     * @param $action
     */
    private function nop($action)
    {
        $this->cursor++;
    }


    /**
     * @param array $command
     * @param array $action
     *
     * @return bool
     */
    private function startConsole(array $command, array $action)
    {
        $this->cursor=0;
        $this->value=0;
        $max = count($action);

        while (isset($command[$this->cursor]) && $this->cursor !== $max) {
            $cursorToUnset = $this->cursor;
            $this->{$command[$this->cursor]}($action[$this->cursor]);
            unset($command[$cursorToUnset]);
        }

        return $this->cursor === $max;
    }


    /**
     * @param OutputInterface $output
     *
     * @return int
     */
    public function day8part2(OutputInterface $output)
    {
        preg_match_all(
            '/(?P<command>jmp|acc|nop)\s(?P<action>[+|\-]\d+)/m',
            $this->getFile('day8part1.txt', true),
            $matches
        );

        $originalProgram = $matches;
        $max = count($matches['action']);

        for($i=0; $i<$max; $i++){
            if ($matches['command'][$i]!=='acc' && (int)substr($matches['action'][$i],1)!==0)
            {
                $matches = $originalProgram;
                $matches['command'][$i] = $matches['command'][$i]==='nop' ? 'jmp' : 'nop';
                if ($this->startConsole($matches['command'], $matches['action'])) {
                    $output->write($this->value);
                    return Command::SUCCESS;
                }
            }
        }

        return Command::FAILURE;
    }

}
