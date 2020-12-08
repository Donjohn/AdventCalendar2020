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
    private array $unsetCursors = [];
    /**
     * @param OutputInterface $output
     *
     * @return int
     */
    public function day8part1(OutputInterface $output): int
    {
        preg_match_all(
            '/(?P<command>jmp|acc|nop)\s(?P<action>[+|\-]\d+)/m',
            $this->getFile('day8part1.txt', true),
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
        if ((int)substr($action,1)!==0) {
            $this->unsetCursors[$this->cursor] = $this->value;
        }
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
        if ((int)substr($action,1)!==0) {
            $this->unsetCursors[$this->cursor] = $this->value;
        }
        $this->cursor++;
    }


    /**
     * @param array $command
     * @param array $action
     * @param int   $startingCursor
     * @param int   $startingValue
     *
     * @return bool
     */
    private function startConsole(array $command, array $action, int $startingCursor = 0, int $startingValue = 0): bool
    {
        $this->cursor = $startingCursor;
        $this->value = $startingValue;
        $max = count($action);

        while (isset($command[$this->cursor]) && $this->cursor < $max) {
            $currentCursor = $this->cursor;
            $this->{$command[$this->cursor]}($action[$this->cursor]);
            unset($command[$currentCursor]);
        }

        return $this->cursor === $max;
    }


    /**
     * @param OutputInterface $output
     *
     * @return int
     */
    public function day8part2(OutputInterface $output): int
    {
        preg_match_all(
            '/(?P<command>jmp|acc|nop)\s(?P<action>[+|\-]\d+)$/m',
            $this->getFile('day8part1.txt', true),
            $originalProgram
        );

        $this->startConsole($originalProgram['command'], $originalProgram['action']);
        foreach ($this->unsetCursors as $cursorToSwap => $value) {
            $testProgram = $originalProgram;
            $testProgram['command'][$cursorToSwap] = $testProgram['command'][$cursorToSwap]==='nop' ? 'jmp' : 'nop';
            if ($this->startConsole($testProgram['command'], $testProgram['action'], $cursorToSwap, $value)) {
                $output->write($this->value);
                return Command::SUCCESS;
            }
        }

        return Command::FAILURE;
    }

}
