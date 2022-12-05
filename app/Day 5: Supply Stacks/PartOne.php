<?php declare(strict_types = 1);

namespace SupplyStacks;

class PartOne extends Part
{
    protected function resolveRearrangedStacks(array $rearrangementProcedure, array $stacks): array
    {
        foreach ($rearrangementProcedure as $step) {
            [$count, $from, $to] = $step;

            for ($i = 1; $i <= $count; $i++) {
                $crate = array_pop($stacks[$from]);
                $stacks[$to][] = $crate;
            }
        }

        return $stacks;
    }
}
