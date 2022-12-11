<?php declare(strict_types = 1);

namespace RopeBridge;

use Solution;

class PartOne implements Solution
{
    private Knot $head;

    private Knot $tail;


    public function run(): void
    {
        $input = file(__DIR__ . '/input', FILE_IGNORE_NEW_LINES);

        $this->head = new Knot();
        $this->tail = new Knot();

        foreach ($input as $i) {
            [$d, $s] = explode(' ', $i);

            for ($s; $s > 0; $s--) {
                $this->moveHead($d);
                $this->moveTail();
            }
        }

        $uniquePositions = [];

        foreach ($this->tail->getHistory() as $position) {
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


    private function moveTail(): void
    {
        if (
            abs($this->head->getX() - $this->tail->getX()) < 2
            && abs($this->head->getY() - $this->tail->getY()) < 2
        ) {
            return;
        }

        $this->tail->move($this->head->getPrevious()[0], $this->head->getPrevious()[1]);
    }
}
