<?php declare(strict_types = 1);

namespace MonkeyInTheMiddle;

use Closure;

class PartTwo extends Part
{
    private int $modulus = 1;


    protected function rounds(): int
    {
        return 10000;
    }


    protected function resolveOperation(array $input): Closure
    {
        $operation = substr($input[2], strlen('  Operation: new = old '));
        [$what, $with] = explode(' ', $operation);

        if ($what === '*') {
            if ($with === 'old') {
                $callable = fn(int &$old) => $old = ($old * $old) % $this->modulus;
            } else {
                $callable = fn(int &$old) => $old = ($old * (int) $with) % $this->modulus;
            }
        } else {
            $callable = static fn(int &$old) => $old += (int) $with;
        }

        return Closure::fromCallable($callable);
    }


    protected function resolveReducer(): Closure
    {
        return Closure::fromCallable(static fn(int &$old): int => $old *= 1);
    }


    protected function resolveTester($input): Closure
    {
        $tester = (int) substr($input[3], strlen('  Test: divisible by '));

        $this->modulus *= $tester;

        return Closure::fromCallable(static fn(int $item): bool => $item % $tester === 0);
    }
}
