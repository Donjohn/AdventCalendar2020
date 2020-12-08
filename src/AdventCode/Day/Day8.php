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
    /**
     * @param OutputInterface $output
     *
     * @return int
     */
    public function day8part1(OutputInterface $output)
    {
        $value = 0;

        preg_match_all(
            '/(?P<command>jmp|acc|nop)\s(?P<action>[+|\-]\d+)/m',
            $this->getFile(__FUNCTION__.'.txt', true),
            $matches
        );

        $cursor = 0;
        while (isset($matches['command'][$cursor])) {
            $cursorToUnset = $cursor;
            $this->{$matches['command'][$cursor]}($matches['action'][$cursor], $cursor, $value);
            unset($matches['command'][$cursorToUnset]);
        }

        $output->write($value);
        return $value > 0 ? Command::SUCCESS : Command::FAILURE;
    }

    /**
     * @param $action
     * @param $cursor
     * @param $value
     */
    private function jmp($action, &$cursor, &$value)
    {
        if ($action[0] === '-') {
            $cursor -= (int)substr($action, 1);
        } else {
            $cursor += (int)substr($action, 1);
        }
    }

    /**
     * @param $action
     * @param $cursor
     * @param $value
     */
    private function acc($action, &$cursor, &$value)
    {
        if ($action[0] === '-') {
            $value -= (int)substr($action, 1);
        } else {
            $value += (int)substr($action, 1);
        }
        $cursor++;
    }

    /**
     * @param $action
     * @param $cursor
     * @param $value
     */
    private function nop($action, &$cursor, &$value)
    {
        $cursor++;
    }

}
