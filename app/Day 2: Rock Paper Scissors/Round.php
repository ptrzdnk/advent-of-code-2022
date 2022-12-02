<?php declare(strict_types = 1);

namespace RockPaperScissors;

class Round
{
    private Shape $opponentChoice;

    private Shape $yourChoice;


    public function __construct(Shape $opponentChoice, Shape $yourChoice)
    {
        $this->opponentChoice = $opponentChoice;
        $this->yourChoice = $yourChoice;
    }


    public function getOpponentChoice(): Shape
    {
        return $this->opponentChoice;
    }


    public function getYourChoice(): Shape
    {
        return $this->yourChoice;
    }
}
