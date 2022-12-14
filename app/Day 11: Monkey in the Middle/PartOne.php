<?php declare(strict_types = 1);

namespace MonkeyInTheMiddle;

use Closure;

class PartOne extends Part
{
    protected function rounds(): int
    {
        return 20;
    }


    protected function resolveOperation(array $input): Closure
    {
        $operation = substr($input[2], strlen('  Operation: new = old '));
        [$what, $with] = explode(' ', $operation);

        if ($what === '*') {
            if ($with === 'old') {
                $callable = static fn(int &$old) => $old *= $old;
            } else {
                $callable = static fn(int &$old) => $old *= (int) $with;
            }
        } else {
            $callable = static fn(int &$old) => $old += (int) $with;
        }

        return Closure::fromCallable($callable);
    }


    protected function resolveReducer(): Closure
    {
        return Closure::fromCallable(static fn(int &$old): int => $old = (int) ($old / 3));
    }


    protected function resolveTester($input): Closure
    {
        $tester = (int) substr($input[3], strlen('  Test: divisible by '));

        return Closure::fromCallable(static fn(int $item): bool => $item % $tester === 0);
    }
}
