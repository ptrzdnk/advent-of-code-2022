<?php declare(strict_types = 1);

class Runner
{
    private const NAME = 'name';
    private const LINK = 'link';
    private const CLASSNAMES = 'classnames';
    private const PART_ONE = 0;
    private const PART_TWO = 1;

    private const PUZZLES_SOLVED = [
        1 => [
            self::NAME => '--- Day 1: Calorie Counting ---',
            self::LINK => 'https://adventofcode.com/2022/day/1',
            self::CLASSNAMES => [
                CalorieCounting\PartOne::class,
                CalorieCounting\PartTwo::class,
            ],
        ],
        [
            self::NAME => '--- Day 2: Rock Paper Scissors ---',
            self::LINK => 'https://adventofcode.com/2022/day/2',
            self::CLASSNAMES => [
                RockPaperScissors\PartOne::class,
                RockPaperScissors\PartTwo::class,
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

        if (isset($puzzleSolved[self::CLASSNAMES][self::PART_ONE])) {
            self::echoAnswer($puzzleSolved[self::CLASSNAMES][self::PART_ONE], 'Part one');
        }

        if (isset($puzzleSolved[self::CLASSNAMES][self::PART_TWO])) {
            self::echoAnswer($puzzleSolved[self::CLASSNAMES][self::PART_TWO], 'Part two');
        }
    }


    /**
     * @param class-string $classname
     */
    private static function echoAnswer(string $classname, string $title): void
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
