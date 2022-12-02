<?php declare(strict_types = 1);

namespace RockPaperScissors;

class Instruction
{
    public const LOSE = 'X';
    public const DRAW = 'Y';
    public const WIN = 'Z';

    private const VALUES = [
        self::LOSE,
        self::DRAW,
        self::WIN,
    ];

    private string $value;


    public function __construct(string $value)
    {
        assert(in_array($value, self::VALUES));

        $this->value = $value;
    }


    public function is(string $value): bool
    {
        return $value === $this->value;
    }
}
