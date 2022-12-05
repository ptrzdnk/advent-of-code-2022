<?php declare(strict_types = 1);

namespace SupplyStacks;

use Solution;

abstract class Part implements Solution
{
    public function run(): void
    {
        $input = file_get_contents(__DIR__ . '/input');

        [$startingStacksInput, $rearrangementProcedureInput] = explode("\n\n", $input);

        $startingStacks = $this->resolveStartingStacks($startingStacksInput);
        $rearrangementProcedure = $this->resolveRearrangementProcedure($rearrangementProcedureInput);
        $rearrangedStacks = $this->resolveRearrangedStacks($rearrangementProcedure, $startingStacks);

        echo implode(array_map(static fn($stack): string => end($stack), $rearrangedStacks));
    }

    private function resolveStartingStacks(string $input): array
    {
        $lines = array_reverse(explode("\n", $input));

        $stackIds = array_shift($lines);
        $stacks = [];

        foreach (str_split($stackIds) as $i => $id) {
            if ($id !== ' ') {
                foreach ($lines as $line) {
                    if ($line[$i] !== ' ') {
                        $stacks[$id][] = $line[$i];
                    }
                }
            }
        }

        return $stacks;
    }


    private function resolveRearrangementProcedure(string $rearrangementProcedureInput): array
    {
        $rearrangementProcedure = [];

        foreach (explode("\n", trim($rearrangementProcedureInput)) as $step) {
            $rearrangementProcedure[] = explode(',', str_replace(['move ', ' from ', ' to '], ['', ',', ','], $step));
        }

        return $rearrangementProcedure;
    }


    abstract protected function resolveRearrangedStacks(array $rearrangementProcedure, array $stacks): array;
}
