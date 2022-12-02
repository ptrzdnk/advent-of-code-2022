<?php declare(strict_types = 1);

namespace RockPaperScissors;

class Shape
{
    public const ROCK = 'R';
    public const PAPER = 'P';
    public const SCISSORS = 'S';

    public const DEFEATS_MAPPING = [
        self::ROCK => self::SCISSORS,
        self::PAPER => self::ROCK,
        self::SCISSORS => self::PAPER,
    ];

    private const VALUES = [
        self::ROCK,
        self::PAPER,
        self::SCISSORS,
    ];

    private string $value;


    public function __construct(string $value)
    {
        assert(in_array($value, self::VALUES));

        $this->value = $value;
    }


    public function getValue(): string
    {
        return $this->value;
    }
}
