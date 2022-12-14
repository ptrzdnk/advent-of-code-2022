<?php declare(strict_types = 1);

namespace MonkeyInTheMiddle;

use Solution;

abstract class Part implements Solution
{
    private const MONKEYS_COUNT = 8;


    abstract protected function rounds(): int;


    public function run(): void
    {
        $input = file(__DIR__ . '/input', FILE_IGNORE_NEW_LINES);
        $input = array_chunk($input, 7);

        $this->init($input);

        for ($i = 1; $i <= $this->rounds(); $i++) {
            foreach ($this->getMonkeys() as $monkey) {
                $monkey->inspect();
                $monkey->throw();
            }
        }

        echo $this->resolve();
    }


    protected function resolve(): int
    {
        $second = $first = 0;

        foreach ($this->getMonkeys() as $monkey) {
            $inspections = $monkey->getInspections();

            $second = $first < $inspections ? $first : max($second, $inspections);
            $first = max($first, $inspections);
        }

        return $first * $second;
    }


    /**
     * @return array<Monkey>
     */
    protected function getMonkeys(): array
    {
        $monkeys = [];

        for ($i = 0; $i < self::MONKEYS_COUNT; $i++) {
            $monkeys[] = $this->{"monkey$i"};
        }

        return $monkeys;
    }


    protected function init(array $input): void
    {
        for ($i = 0; $i < self::MONKEYS_COUNT; $i++) {
            $this->{"monkey$i"} = new Monkey(
                $this->resolveItems($input[$i]),
                $this->resolveOperation($input[$i]),
                $this->resolveReducer(),
                $this->resolveTester($input[$i]),
            );
        }

        foreach ($this->getMonkeys() as $i => $monkey) {
            $success = $input[$i][4][strlen('    If true: throw to monkey ')];
            $failure = $input[$i][5][strlen('    If false: throw to monkey ')];

            $monkey->setSuccess($this->{"monkey$success"});
            $monkey->setFailure($this->{"monkey$failure"});
        }
    }


    protected function resolveItems($input): array
    {
        return array_map(
            static fn(string $item): int => (int) $item,
            explode(', ', substr($input[1], strlen('  Starting items: '))),
        );
    }
}
