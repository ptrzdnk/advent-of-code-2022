<?php declare(strict_types = 1);

namespace RockPaperScissors;

use Solution;

abstract class Part implements Solution
{
    protected const SHAPE_MAPPING = [
        'A' => Shape::ROCK,
        'B' => Shape::PAPER,
        'C' => Shape::SCISSORS,
        'X' => Shape::ROCK,
        'Y' => Shape::PAPER,
        'Z' => Shape::SCISSORS,
    ];


    public function run(): void
    {
        $input = file(__DIR__ . '/input', FILE_IGNORE_NEW_LINES);

        $totalScore = 0;

        foreach ($input as $strategyGuide) {
            $round = $this->mapStrategyGuideToRound($strategyGuide);

            $totalScore += ScoreResolver::resolveShapeScore($round) + ScoreResolver::resolveOutcomeScore($round);
        }

        echo $totalScore;
    }


    abstract protected function mapStrategyGuideToRound(string $strategyGuide);
}
