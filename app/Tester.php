<?php declare(strict_types = 1);

class Tester
{
    private const NAME = 'name';
    private const EXPECTED_ANSWERS = 'expectedAnswers';
    private const PART_ONE = 0;
    private const PART_TWO = 1;

    private const TESTS = [
        1 => [
            self::NAME => '--- Day 1: Calorie Counting ---',
            self::EXPECTED_ANSWERS => [
                CalorieCounting\PartOne::class => '69501',
                CalorieCounting\PartTwo::class => '202346',
            ],
        ],
        [
            self::NAME => '--- Day 2: Rock Paper Scissors ---',
            self::EXPECTED_ANSWERS => [
                RockPaperScissors\PartOne::class => '11906',
                RockPaperScissors\PartTwo::class => '11186',
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

        $classnames = array_keys($test[self::EXPECTED_ANSWERS]);
        $expectedAnswers = array_values($test[self::EXPECTED_ANSWERS]);

        if (isset($classnames[self::PART_ONE])) {
            self::echoResult($classnames[self::PART_ONE], $expectedAnswers[self::PART_ONE], 'Part one');
        }

        if (isset($classnames[self::PART_TWO])) {
            self::echoResult($classnames[self::PART_TWO], $expectedAnswers[self::PART_TWO], 'Part two');
        }
    }


    /**
     * @param class-string $classname
     */
    private static function echoResult(string $classname, string $expectedAnswer, string $title): void
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
