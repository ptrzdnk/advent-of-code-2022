<?php declare(strict_types = 1);

namespace CathodeRayTube;

use Solution;

class PartOne implements Solution
{
    public function run(): void
    {
        $input = file(__DIR__ . '/input', FILE_IGNORE_NEW_LINES);

        $r = [1];

        foreach ($input as $i) {
            if ($i === 'noop') {
                $r[] = end($r);
            } else {
                [, $s] = explode(' ', $i);
                $r[] = end($r);
                $r[] = end($r) + (int) $s;
            }
        }

        $a = 0;

        foreach ([20, 60, 100, 140, 180, 220] as $nth) {
            $a += $nth * $r[$nth - 1];
        }

        echo $a;
    }
}
