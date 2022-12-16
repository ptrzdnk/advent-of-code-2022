<?php declare(strict_types = 1);

namespace HillClimbingAlgorithm;

class Square
{
    private int $x;

    private int $y;

    private int $height;

    private int $distanceToStart;

    private int $distanceToEnd;

    /**
     * @var array<Square>
     */
    private array $adjacents = [];

    private Square $parent;


    public function __construct(int $x, int $y, int $height)
    {
        $this->x = $x;
        $this->y = $y;
        $this->height = $height;
    }


    public function setDistanceToStart(int $distance): void
    {
        $this->distanceToStart = $distance;
    }


    public function setDistanceToEnd(int $distance): void
    {
        $this->distanceToEnd = $distance;
    }


    public function addAdjacent(Square $adjacent): void
    {
        $this->adjacents[] = $adjacent;
    }


    public function setParent(Square $parent): void
    {
        $this->parent = $parent;
    }


    public function getX(): int
    {
        return $this->x;
    }


    public function getY(): int
    {
        return $this->y;
    }


    public function getHeight(): int
    {
        return $this->height;
    }


    public function getDistanceToStart(): int
    {
        return $this->distanceToStart;
    }


    public function getDistance(): int
    {
        return $this->distanceToStart + $this->distanceToEnd;
    }


    /**
     * @return array<Square>
     */
    public function getAdjacents(): array
    {
        return $this->adjacents;
    }


    public function getParent(): Square
    {
        return $this->parent;
    }
}
