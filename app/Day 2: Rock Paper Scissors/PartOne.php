<?php declare(strict_types = 1);

namespace RockPaperScissors;

class PartOne extends Part
{
    protected function mapStrategyGuideToRound(string $strategyGuide): Round
    {
        $opponentChoice = new Shape(self::SHAPE_MAPPING[$strategyGuide[0]]);
        $yourChoice = new Shape(self::SHAPE_MAPPING[$strategyGuide[2]]);

        return new Round($opponentChoice, $yourChoice);
    }
}
