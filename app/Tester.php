<?php declare(strict_types = 1);

class Tester
{
    private const NAME = 'name';
    private const EXPECTED_ANSWERS = 'expectedAnswers';
    private const PART_ONE = 'Part one';
    private const PART_TWO = 'Part two';

    private const TESTS = [
        1 => [
            self::NAME => '--- Day 1: Calorie Counting ---',
            self::EXPECTED_ANSWERS => [
                self::PART_ONE => [CalorieCounting\PartOne::class => '69501'],
                self::PART_TWO => [CalorieCounting\PartTwo::class => '202346'],
            ],
        ],
        [
            self::NAME => '--- Day 2: Rock Paper Scissors ---',
            self::EXPECTED_ANSWERS => [
                self::PART_ONE => [RockPaperScissors\PartOne::class => '11906'],
                self::PART_TWO => [RockPaperScissors\PartTwo::class => '11186'],
            ],
        ],
        [
            self::NAME => '--- Day 3: Rucksack Reorganization ---',
            self::EXPECTED_ANSWERS => [
                self::PART_ONE => [RucksackReorganization\PartOne::class => '8139'],
                self::PART_TWO => [RucksackReorganization\PartTwo::class => '2668'],
                'Part one (strpos)' => [RucksackReorganization\PartOneStrpos::class => '8139'],
                'Part two (strpos)' => [RucksackReorganization\PartTwoStrpos::class => '2668'],
            ],
        ],
        [
            self::NAME => '--- Day 4: Camp Cleanup ---',
            self::EXPECTED_ANSWERS => [
                self::PART_ONE => [CampCleanup\PartOne::class => '562'],
                self::PART_TWO => [CampCleanup\PartTwo::class => '924'],
            ],
        ],
        [
            self::NAME => '--- Day 5: Supply Stacks ---',
            self::EXPECTED_ANSWERS => [
                self::PART_ONE => [SupplyStacks\PartOne::class => 'TQRFCBSJJ'],
                self::PART_TWO => [SupplyStacks\PartTwo::class => 'RMHFJNVFP'],
            ],
        ],
        [
            self::NAME => '--- Day 6: Tuning Trouble ---',
            self::EXPECTED_ANSWERS => [
                self::PART_ONE => [TuningTrouble\PartOne::class => '1134'],
                self::PART_TWO => [TuningTrouble\PartTwo::class => '2263'],
            ],
        ],
        [
            self::NAME => '--- Day 7: No Space Left On Device ---',
            self::EXPECTED_ANSWERS => [
                self::PART_ONE => [NoSpaceLeftOnDevice\PartOne::class => '1844187'],
                self::PART_TWO => [NoSpaceLeftOnDevice\PartTwo::class => '4978279'],
            ],
        ],
        [
            self::NAME => '--- Day 8: Treetop Tree House ---',
            self::EXPECTED_ANSWERS => [
                self::PART_ONE => [TreetopTreeHouse\PartOne::class => '1854'],
                self::PART_TWO => [TreetopTreeHouse\PartTwo::class => '527340'],
            ],
        ],
        [
            self::NAME => '--- Day 9: Rope Bridge ---',
            self::EXPECTED_ANSWERS => [
                self::PART_ONE => [RopeBridge\PartOne::class => '6026'],
                self::PART_TWO => [RopeBridge\PartTwo::class => '2273'],
            ],
        ],
        [
            self::NAME => '--- Day 10: Cathode-Ray Tube ---',
            self::EXPECTED_ANSWERS => [
                self::PART_ONE => [CathodeRayTube\PartOne::class => '14820'],
                self::PART_TWO => [CathodeRayTube\PartTwo::class => "\n###..####.####.#..#.####.####.#..#..##.#\n#..#....#.#....#.#..#....#....#..#.#..#.\n#..#...#..###..##...###..###..####.#..#.\n###...#...#....#.#..#....#....#..#.#####\n#.#..#....#....#.#..#....#....#..#.#..#.\n#..#.####.####.#..#.####.#....#..#.#..#."],
            ],
        ],
        [
            self::NAME => '--- Day 11: Monkey in the Middle ---',
            self::EXPECTED_ANSWERS => [
                self::PART_ONE => [MonkeyInTheMiddle\PartOne::class => '58794'],
                self::PART_TWO => [MonkeyInTheMiddle\PartTwo::class => '20151213744'],
            ],
        ],
        [
            self::NAME => '--- Day 12: Hill Climbing Algorithm ---',
            self::EXPECTED_ANSWERS => [
                self::PART_ONE => [HillClimbingAlgorithm\PartOne::class => '394'],
                self::PART_TWO => [HillClimbingAlgorithm\PartTwo::class => '388'],
            ],
        ],
        [
            self::NAME => '--- Day 13: Distress Signal ---',
            self::EXPECTED_ANSWERS => [
                self::PART_ONE => [DistressSignal\PartOne::class => '6428'],
                self::PART_TWO => [DistressSignal\PartTwo::class => '22464'],
            ],
        ],
        [
            self::NAME => '--- Day 14: Regolith Reservoir ---',
            self::EXPECTED_ANSWERS => [
                self::PART_ONE => [RegolithReservoir\PartOne::class => '610'],
                self::PART_TWO => [RegolithReservoir\PartTwo::class => '27194'],
            ],
        ],
        [
            self::NAME => '--- Day 15: Beacon Exclusion Zone ---',
            self::EXPECTED_ANSWERS => [
                self::PART_ONE => [BeaconExclusionZone\PartOne::class => '4883971'],
                self::PART_TWO => [BeaconExclusionZone\PartTwo::class => '12691026767556'],
            ],
        ],
    ];


    public static function test(?int $day = null): void
    {
        $day === null ? self::testAll() : self::testOne($day);
    }


    private static function testAll(): void
    {
        foreach (array_keys(self::TESTS) as $day) {
            self::testOne($day);
        }
    }


    private static function testOne(int $day): void
    {
        if (!isset(self::TESTS[$day])) {
            self::exit("Day $day not tested yet.");
        }

        $test = self::TESTS[$day];

        echo $test[self::NAME] . "\n";

        foreach ($test[self::EXPECTED_ANSWERS] as $title => $expectedAnswer) {
            self::echoResult($title, key($expectedAnswer), current($expectedAnswer));
        }
    }


    /**
     * @param class-string $classname
     */
    private static function echoResult(string $title, string $classname, string $expectedAnswer): void
    {
        $class = new $classname;
        assert($class instanceof Solution);

        ob_start();
        $class->run();
        $actualAnswer = ob_get_clean();

        echo $actualAnswer === $expectedAnswer
            ? "$title result: OK\n"
            : "$title result: $actualAnswer does NOT match expected $expectedAnswer\n";
    }


    private static function exit(string $message): void
    {
        echo "$message\n";

        exit;
    }
}
