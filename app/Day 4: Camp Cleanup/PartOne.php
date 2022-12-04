<?php declare(strict_types = 1);

namespace CampCleanup;

use Helper;
use Solution;

class PartOne implements Solution
{
    public function run(): void
    {
        $input = file(__DIR__ . '/input', FILE_IGNORE_NEW_LINES);

        $c = 0;

        foreach ($input as $a) {
            [$a1, $a2, $a3, $a4] = explode('-', str_replace(',', '-', $a));

            $c += (int) (($a1 <= $a3 && $a2 >= $a4) || ($a3 <= $a1 && $a4 >= $a2));
        }

        echo $c;
    }
}
