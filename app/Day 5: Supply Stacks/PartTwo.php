<?php declare(strict_types = 1);

namespace SupplyStacks;

class PartTwo extends Part
{
    protected function resolveRearrangedStacks(array $rearrangementProcedure, array $stacks): array
    {
        foreach ($rearrangementProcedure as $step) {
            [$count, $from, $to] = $step;

            $crane = [];

            for ($i = 1; $i <= $count; $i++) {
                $crate = array_pop($stacks[$from]);
                $crane[] = $crate;
            }

            for ($i = 1; $i <= $count; $i++) {
                $crate = array_pop($crane);
                $stacks[$to][] = $crate;
            }
        }

        return $stacks;
    }
}
