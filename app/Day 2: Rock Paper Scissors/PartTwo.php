<?php declare(strict_types = 1);

namespace RockPaperScissors;

class PartTwo extends Part
{
    protected function mapStrategyGuideToRound(string $strategyGuide): Round
    {
        $opponentChoice = new Shape(self::SHAPE_MAPPING[$strategyGuide[0]]);
        $instruction = new Instruction($strategyGuide[2]);

        if ($instruction->is(Instruction::LOSE)) {
            $yourChoice = new Shape(Shape::DEFEATS_MAPPING[$opponentChoice->getValue()]);

            return new Round($opponentChoice, $yourChoice);
        }

        if ($instruction->is(Instruction::WIN)) {
            $yourChoice = new Shape(array_flip(Shape::DEFEATS_MAPPING)[$opponentChoice->getValue()]);

            return new Round($opponentChoice, $yourChoice);
        }

        $yourChoice = $opponentChoice;

        return new Round($opponentChoice, $yourChoice);
    }
}
