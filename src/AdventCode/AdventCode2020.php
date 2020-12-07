<?php


namespace App\AdventCode;


use App\AdventCode\Day\Day1;
use App\AdventCode\Day\Day2;
use App\AdventCode\Day\Day3;
use App\AdventCode\Day\Day4;
use App\AdventCode\Day\Day5;
use App\AdventCode\Day\Day6;
use App\AdventCode\Day\Day7;

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
    use Day5;
    use Day6;
    use Day7;

    /**
     * @var string
     */
    private string $projectDir;

    public function __construct(string $projectDir)
    {
        $this->projectDir = $projectDir;
    }

}

