<?php


namespace App\AdventCode;


use App\AdventCode\Day\Day1;
use App\AdventCode\Day\Day2;
use App\AdventCode\Day\Day3;
use App\AdventCode\Day\Day4;

/**
 * Class AdventCode2020
 *
 * @package App\AdventCode
 */
class AdventCode2020
{

    use Day1;
    use Day2;
    use Day3;
    use Day4;

    /**
     * @var string
     */
    private string $projectDir;

    public function __construct(string $projectDir)
    {
        $this->projectDir = $projectDir;
    }

}

