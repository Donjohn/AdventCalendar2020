<?php

namespace App\Tests;

use App\AdventCode\AdventCode2020;
use App\Command\AdventCodeCommand;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Class AdventCode2020Test
 *
 * @package App\Tests
 */
class AdventCode2020Test extends KernelTestCase
{
    /**
     * @return int[][][]
     */
    public function provideDayAndPart()
    {
        return
        [
            [
                [1, 1],['365619']
            ],
            [
                [1, 2],['236873508']
            ],
            [
                [2, 1],['536']
            ],
            [
                [2, 2],['558']
            ],
            [
                [3,1],['234']
            ],
            [
                [3,2],['5813773056']
            ],
            [
                [4,1],['264']
            ],
            [
                [4,2],['224']
            ],
            [
                [5,1],['996']
            ],
            [
                [5,2],['671']
            ],
            [
                [6,1],['6585']
            ],
            [
                [6,2],['3276']
            ],
            [
                [7,1],['326']
            ],
            [
                [7,2],['5635']
            ],
            [
                [8,1],['1475']
            ]
        ];
    }

    /**
     * @dataProvider provideDayAndPart
     *
     * @param array $dayAndPart
     * @param array $result
     */
    public function testExecute(array $dayAndPart, array $result){

        $kernel = static::createKernel();
        $kernel->boot();

        $application = new Application($kernel);
        $application->add(new AdventCodeCommand($kernel->getContainer()->get(AdventCode2020::class)));


        $command = $application->get('advent-code:2020');
        $commandTester = new CommandTester($command);
        [$day, $part] = $dayAndPart;
        $commandTester->execute(['day' => $day, 'part' => $part]);

        self::assertEquals($result[0],$commandTester->getDisplay());
    }
}
