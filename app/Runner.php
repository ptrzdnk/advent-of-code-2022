<?php declare(strict_types = 1);

class Runner
{
    private const NAME = 'name';
    private const LINK = 'link';
    private const CLASSNAMES = 'classnames';
    private const PART_ONE = 'Part one';
    private const PART_TWO = 'Part two';

    private const PUZZLES_SOLVED = [
        1 => [
            self::NAME => '--- Day 1: Calorie Counting ---',
            self::LINK => 'https://adventofcode.com/2022/day/1',
            self::CLASSNAMES => [
                self::PART_ONE => CalorieCounting\PartOne::class,
                self::PART_TWO => CalorieCounting\PartTwo::class,
            ],
        ],
        [
            self::NAME => '--- Day 2: Rock Paper Scissors ---',
            self::LINK => 'https://adventofcode.com/2022/day/2',
            self::CLASSNAMES => [
                self::PART_ONE => RockPaperScissors\PartOne::class,
                self::PART_TWO => RockPaperScissors\PartTwo::class,
            ],
        ],
        [
            self::NAME => '--- Day 3: Rucksack Reorganization ---',
            self::LINK => 'https://adventofcode.com/2022/day/3',
            self::CLASSNAMES => [
                self::PART_ONE => RucksackReorganization\PartOne::class,
                self::PART_TWO => RucksackReorganization\PartTwo::class,
                'Part one (strpos)' => RucksackReorganization\PartOneStrpos::class,
                'Part two (strpos)' => RucksackReorganization\PartTwoStrpos::class,
            ],
        ],
        [
            self::NAME => '--- Day 4: Camp Cleanup ---',
            self::LINK => 'https://adventofcode.com/2022/day/4',
            self::CLASSNAMES => [
                self::PART_ONE => CampCleanup\PartOne::class,
                self::PART_TWO => CampCleanup\PartTwo::class,
            ],
        ],
        [
            self::NAME => '--- Day 5: Supply Stacks ---',
            self::LINK => 'https://adventofcode.com/2022/day/5',
            self::CLASSNAMES => [
                self::PART_ONE => SupplyStacks\PartOne::class,
                self::PART_TWO => SupplyStacks\PartTwo::class,
            ],
        ],
    ];


    public static function run(?int $day = null): void
    {
        $day === null ? self::runAll() : self::runOne($day);
    }


    private static function runAll(): void
    {
        foreach (array_keys(self::PUZZLES_SOLVED) as $day) {
            self::runOne($day);
        }
    }


    private static function runOne(int $day): void
    {
        if ($day < 1 || $day > 25) {
            self::exit("Day $day? Advent overflow?");
        }

        if (!isset(self::PUZZLES_SOLVED[$day])) {
            self::exit("Day $day? Maybe later...");
        }

        $puzzleSolved = self::PUZZLES_SOLVED[$day];

        echo $puzzleSolved[self::NAME] . "\n";
        echo $puzzleSolved[self::LINK] . "\n";

        foreach ($puzzleSolved[self::CLASSNAMES] as $title => $classname) {
            self::echoAnswer($title, $classname);
        }
    }


    /**
     * @param class-string $classname
     */
    private static function echoAnswer(string $title, string $classname): void
    {
        $class = new $classname;
        assert($class instanceof Solution);

        echo "$title answer: ";
        $class->run();
        echo "\n";
    }


    private static function exit(string $message): void
    {
        echo "$message\n";

        exit;
    }
}
