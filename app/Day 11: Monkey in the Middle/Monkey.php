<?php declare(strict_types = 1);

namespace MonkeyInTheMiddle;

use Closure;

class Monkey
{
    private array $items;

    private Closure $operation;

    private Closure $reducer;

    private Closure $tester;

    private Monkey $success;

    private Monkey $failure;

    private int $inspections = 0;


    public function __construct(
        array $items,
        Closure $operation,
        Closure $reducer,
        Closure $tester,
    ) {
        $this->items = $items;
        $this->operation = $operation;
        $this->reducer = $reducer;
        $this->tester = $tester;
    }


    public function setSuccess(Monkey $success): void
    {
        $this->success = $success;
    }


    public function setFailure(Monkey $failure): void
    {
        $this->failure = $failure;
    }


    public function inspect(): void
    {
        array_walk($this->items, $this->operation);
        array_walk($this->items, $this->reducer);

        $this->inspections += count($this->items);
    }


    public function throw(): void
    {
        foreach ($this->items as $item) {
            $this->tester->__invoke($item)
                ? $this->success->catch(array_shift($this->items))
                : $this->failure->catch(array_shift($this->items));
        }
    }


    public function catch($item): void
    {
        $this->items[] = $item;
    }


    public function getInspections(): int
    {
        return $this->inspections;
    }
}