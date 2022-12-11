<?php declare(strict_types = 1);

namespace RopeBridge;

use Solution;

class PartTwo implements Solution
{
    private Knot $head;

    private Knot $knot1;

    private Knot $knot2;

    private Knot $knot3;

    private Knot $knot4;

    private Knot $knot5;

    private Knot $knot6;

    private Knot $knot7;

    private Knot $knot8;

    private Knot $knot9;


    public function run(): void
    {
        $input = file(__DIR__ . '/input', FILE_IGNORE_NEW_LINES);

        $this->head = new Knot();

        for ($k = 1; $k <= 9; $k++) {
            $this->{"knot$k"} = new Knot;
        }

        foreach ($input as $i) {
            [$d, $s] = explode(' ', $i);

            for ($s; $s > 0; $s--) {
                $this->moveHead($d);

                for ($k = 1; $k <= 9; $k++) {
                    $this->moveKnot($k);
                }
            }
        }

        $uniquePositions = [];

        foreach ($this->knot9->getHistory() as $position) {
            $uniquePositions["$position[0]|$position[1]"] = $position;
        }

        echo count($uniquePositions);
    }


    private function moveHead(string $d): void
    {
        if ($d === 'D') {
            $this->head->moveD();
        } elseif ($d === 'L') {
            $this->head->moveL();
        } elseif ($d === 'R') {
            $this->head->moveR();
        } elseif ($d === 'U') {
            $this->head->moveU();
        }
    }


    private function moveKnot(int $k): void
    {
        $previousK = $k - 1;
        $previous = $previousK === 0 ? $this->head : $this->{"knot$previousK"};

        /** @var Knot $actual */
        $actual = $this->{"knot$k"};

        if (
            abs($previous->getX() - $actual->getX()) < 2
            && abs($previous->getY() - $actual->getY()) < 2
        ) {
            return;
        }

        $moveToX = abs($previous->getX() - $actual->getX()) === 2
            ? ($previous->getX() + $actual->getX()) / 2
            : $previous->getX();

        $moveToY = abs($previous->getY() - $actual->getY()) === 2
            ? ($previous->getY() + $actual->getY()) / 2
            : $previous->getY();

        $actual->move($moveToX, $moveToY);
    }
}
