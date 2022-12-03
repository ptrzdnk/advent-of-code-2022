<?php declare(strict_types = 1);

namespace RucksackReorganization;

use Solution;

class PartTwoStrpos implements Solution
{
    public function run(): void
    {
        $input = file(__DIR__ . '/input', FILE_IGNORE_NEW_LINES);

        $sum = 0;

        $c = '';
        $i = 1;

        foreach ($input as $r) {
            $c .= $r;

            ${"p$i"} = strlen($c);

            if ($i === 3) {
                for ($j = 0; $j < $p1; $j++) {
                    if (
                        strpos($c, $c[$j]) >= $j && strpos($c, $c[$j]) < $p1
                        && strpos($c, $c[$j], $p1) >= $p1 && strpos($c, $c[$j], $p1) < $p2
                        && strpos($c, $c[$j], $p2) >= $p2
                    ) {
                        $sum += strpos('_abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', $c[$j]);
                    }
                }

                $c = '';
                $i = 0;
            }

            $i++;
        }

        echo $sum;
    }
}
