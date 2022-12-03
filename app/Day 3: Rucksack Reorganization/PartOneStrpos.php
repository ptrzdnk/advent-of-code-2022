<?php declare(strict_types = 1);

namespace RucksackReorganization;

use Solution;

class PartOneStrpos implements Solution
{
    public function run(): void
    {
        $input = file(__DIR__ . '/input', FILE_IGNORE_NEW_LINES);

        $sum = 0;

        foreach ($input as $r) {
            $l = strlen($r) / 2;

            for ($i = 0; $i < $l; $i++) {
                if (strpos($r, $r[$i], $l) !== false && strpos($r, $r[$i]) >= $i) {
                    $sum += strpos('_abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', $r[$i]);
                }
            }
        }

        echo $sum;
    }
}
