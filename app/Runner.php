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
            self::exit('advent overflow');
        }

        if (!isset(self::PUZZLES_SOLVED[$day])) {
            self::exit('maybe later');
        }

        $puzzleSolved = self::PUZZLES_SOLVED[$day];

        echo $puzzleSolved[self::NAME] . "\n";
        echo $puzzleSolved[self::LINK] . "\n";

        if (isset($puzzleSolved[self::CLASSNAMES][self::PART_ONE])) {
            self::echoAnswer($puzzleSolved[self::CLASSNAMES][self::PART_ONE], 'Part one answer:');
        }

        if (isset($puzzleSolved[self::CLASSNAMES][self::PART_TWO])) {
            self::echoAnswer($puzzleSolved[self::CLASSNAMES][self::PART_TWO], 'Part two answer:');
        }
    }


    /**
     * @param class-string $classname
     */
    private static function echoAnswer(string $classname, string $title): void
    {
        $class = new $classname;
        assert($class instanceof Solution);

        echo "$title ";
        $class->run();
        echo "\n";
    }


    private static function exit(?string $message = null): void
    {
        if ($message !== null) {
            echo "$message\n";
        }

        exit;
    }
}
