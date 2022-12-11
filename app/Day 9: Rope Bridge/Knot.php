<?php declare(strict_types = 1);

namespace RopeBridge;

class Knot
{
    private int $x = 0;

    private int $y = 0;
    
    private array $history = [];


    public function getX(): int
    {
        return $this->x;
    }


    public function getY(): int
    {
        return $this->y;
    }


    public function moveD(): void
    {
        $this->move($this->x, $this->y + 1);
    }


    public function moveL(): void
    {
        $this->move($this->x - 1, $this->y);
    }


    public function moveR(): void
    {
        $this->move($this->x + 1, $this->y);
    }


    public function moveU(): void
    {
        $this->move($this->x, $this->y - 1);
    }


    public function move(int $x, int $y): void
    {
        $this->history[] = [$this->x, $this->y];

        $this->x = $x;
        $this->y = $y;
    }


    public function getPrevious(): array
    {
        return end($this->history);
    }


    public function getHistory(): array
    {
        return $this->history;
    }
}