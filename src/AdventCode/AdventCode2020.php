<?php


namespace App\AdventCode;


use App\AdventCode\Day\Day1;
use App\AdventCode\Day\Day2;
use App\AdventCode\Day\Day3;
use App\AdventCode\Day\Day4;
use App\AdventCode\Day\Day5;
use App\AdventCode\Day\Day6;
use App\AdventCode\Day\Day7;
use App\AdventCode\Day\Day8;

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
    use Day8;

    /**
     * @var string
     */
    private string $projectDir;

    public function __construct(string $projectDir)
    {
        $this->projectDir = $projectDir;
    }

    /**
     * @param string $file
     *
     * @param bool   $plainText
     *
     * @return array|false
     */
    private function getFile(string $file, bool $plainText = false)
    {
        $path = $this->projectDir.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.$file;
        return $plainText ?
            file_get_contents($path):
            file($path, FILE_IGNORE_NEW_LINES);
    }

}

