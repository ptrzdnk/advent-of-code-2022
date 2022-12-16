<?php declare(strict_types = 1);

namespace HillClimbingAlgorithm;

use Solution;

abstract class Part implements Solution
{
    public const HEIGHTS = 'abcdefghijklmnopqrstuvwxyz';

    private const MAX_ELEVATION = 1;

    /**
     * @var array<array<Square>>
     */
    private array $area = [];

    private Square $start;

    private Square $end;


    protected function findPath(): array
    {
        $current = $this->start;

        $todo = [];
        $done = [];

        while($current !== $this->end) {
            foreach ($current->getAdjacents() as $adjacent) {
                if (in_array($adjacent, $done, true)) {
                    continue;
                }

                if ($adjacent->getHeight() > $current->getHeight() + self::MAX_ELEVATION) {
                    continue;
                }

                if (!in_array($adjacent, $todo, true) || $current->getDistanceToStart() + 1 < $adjacent->getDistanceToStart()) {

                    $adjacent->setDistanceToStart($current->getDistanceToStart() + 1);
                    $adjacent->setParent($current);

                    if (!in_array($adjacent, $todo, true)) {
                        $todo[] = $adjacent;
                    }
                }
            }

            $done[] = $current;

            usort($todo, static fn(Square $a, Square $b) => $a->getDistance() <=> $b->getDistance());
            $current = array_shift($todo);
        }

        $path = [];

        while($current !== $this->start) {
            $parent = $current->getParent();

            $path[] = $parent;
            $current = $parent;
        }

        return $path;
    }


    protected function init(bool | array $input): void
    {
        foreach ($input as $y => $row) {
            $y++;

            foreach (str_split($row) as $x => $char) {
                $x++;

                if ($char === 'S') {
                    $this->start = $square = new Square($x, $y, 0);
                } elseif ($char === 'E') {
                    $this->end = $square = new Square($x, $y, strpos(self::HEIGHTS, 'z'));
                } else {
                    $square = new Square($x, $y, strpos(self::HEIGHTS, $char));
                }

                $this->area[$y][$x] = $square;
            }
        }

        foreach ($this->area as $row) {
            foreach ($row as $square) {
                $square->setDistanceToStart(
                    abs($square->getX() - $this->start->getX())
                    + abs($square->getY() - $this->start->getY()),
                );
                $square->setDistanceToEnd(
                    abs($square->getX() - $this->end->getX())
                    + abs($square->getY() - $this->end->getY()),
                );

                $this->resolveAdjacentSquare($square, -1, 0);
                $this->resolveAdjacentSquare($square, +1, 0);
                $this->resolveAdjacentSquare($square, 0, +1);
                $this->resolveAdjacentSquare($square, 0, -1);
            }
        }
    }


    private function resolveAdjacentSquare(Square $square, int $dy, int $dx): void
    {
        $adjacent = $this->area[$square->getY() + $dy][$square->getX() + $dx] ?? null;

        if ($adjacent === null) {
            return;
        }

        if ($adjacent->getHeight() - $square->getHeight() > self::MAX_ELEVATION) {
            return;
        }

        $square->addAdjacent($adjacent);
    }
}
