<?php declare(strict_types = 1);

namespace RockPaperScissors;

class ScoreResolver
{
    private const SHAPE_SCORING = [
        Shape::ROCK => 1,
        Shape::PAPER => 2,
        Shape::SCISSORS => 3,
    ];

    private const WIN = 6;
    private const DRAW = 3;
    private const LOSS = 0;


    public static function resolveShapeScore(Round $round): int
    {
        return self::SHAPE_SCORING[$round->getYourChoice()->getValue()];
    }


    public static function resolveOutcomeScore(Round $round): int
    {
        $opponentChoice = $round->getOpponentChoice()->getValue();
        $yourChoice = $round->getYourChoice()->getValue();

        if ($opponentChoice === Shape::DEFEATS_MAPPING[$yourChoice]) {
            return self::WIN;
        }

        if ($opponentChoice === $yourChoice) {
            return self::DRAW;
        }

        return self::LOSS;
    }
}
