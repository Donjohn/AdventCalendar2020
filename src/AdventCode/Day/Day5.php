<?php


namespace App\AdventCode\Day;


/**
 * Trait Day5
 *
 * @package App\AdventCode\Day
 */
trait Day5
{
    /**
     * @return int
     */
    public function day5part1(): int
    {
        $lines = $this->getFile('day5.txt');


        $value = 0;
        foreach ($lines as $line) {

            $calc = $this->getIdSeat($line);

            $value = $calc > $value ? $calc : $value;
        }

        return $value;
    }

    /**
     * @return int
     */
    public function day5part2(): int
    {
        $lines = $this->getFile('day5.txt');


        $seats = [];
        foreach ($lines as $line) {
            $seats[] = $this->getIdSeat($line);
        }
        sort($seats);

        $allSeats = array_fill($seats[0], count($seats), '');

        return current(array_diff(array_keys($allSeats), $seats));
    }

    /**
     * @param $line
     *
     * @return int
     */
    public function getIdSeat(string $line): int
    {
        $startingRow = 0;
        $endingRow = 127;
        $nbRow = 128;
        $startingColumn = 0;
        $endingColumn = 7;
        $nbColumn = 8;

        $i = 0;
        while ($i < 7) {
            $nbRow /= 2;
            $startingRow = $line[$i] === 'B' ? $startingRow + $nbRow : $startingRow;
            $endingRow = $line[$i] === 'F' ? $endingRow - $nbRow : $endingRow;
            $i++;
        }
        $row = $startingRow < $endingRow ? $startingRow : $endingRow;

        while ($i < 10) {
            $nbColumn /= 2;
            $startingColumn = $line[$i] === 'R' ? $startingColumn + $nbColumn : $startingColumn;
            $endingColumn = $line[$i] === 'L' ? $endingColumn - $nbColumn : $endingColumn;
            $i++;
        }

        $column = $startingColumn < $endingColumn ? $startingColumn : $endingColumn;

        return $row * 8 + $column;
    }


}
