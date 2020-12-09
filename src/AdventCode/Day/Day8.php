<?php


namespace App\AdventCode\Day;


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
     * @return int
     */
    public function day8part1(): int
    {
        preg_match_all(
            '/(?P<command>jmp|acc|nop)\s(?P<action>[+|\-]\d+)/m',
            $this->getFile('day8.txt', true),
            $matches
        );

        $this->startConsole($matches['command'], $matches['action']);

        return $this->value;
    }

    /**
     * @param $action
     */
    private function jmp($action)
    {
        if (substr($action,1)!==0) {
            $this->unsetCursors[$this->cursor] = $this->value;
        }
        if ($action[0] === '-') {
            $this->cursor -= substr($action, 1);
        } else {
            $this->cursor += substr($action, 1);
        }
    }

    /**
     * @param $action
     */
    private function acc($action)
    {
        if ($action[0] === '-') {
            $this->value -= substr($action, 1);
        } else {
            $this->value += substr($action, 1);
        }
        $this->cursor++;
    }

    /**
     * @param $action
     */
    private function nop($action)
    {
        if (substr($action,1)!==0) {
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
     * @return int
     */
    public function day8part2(): int
    {
        preg_match_all(
            '/(?P<command>jmp|acc|nop)\s(?P<action>[+|\-]\d+)$/m',
            $this->getFile('day8.txt', true),
            $originalProgram
        );

        $this->startConsole($originalProgram['command'], $originalProgram['action']);
        foreach ($this->unsetCursors as $cursorToSwap => $value) {
            $testProgram = $originalProgram;
            $testProgram['command'][$cursorToSwap] = $testProgram['command'][$cursorToSwap]==='nop' ? 'jmp' : 'nop';
            if ($this->startConsole($testProgram['command'], $testProgram['action'], $cursorToSwap, $value)) {
                return $this->value;
            }
        }

        return 0;
    }

}
