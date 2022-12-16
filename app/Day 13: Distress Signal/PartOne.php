<?php declare(strict_types = 1);

namespace DistressSignal;

use Solution;

class PartOne implements Solution
{
    public function run(): void
    {
        $input = file(__DIR__ . '/input', FILE_IGNORE_NEW_LINES);
        array_unshift($input, '');

        $sum = 0;

        foreach(array_chunk($input, 3) as $i => $pair) {
            [, $left, $right] = $pair;

            $sum += Comparer::compare(Parser::parse($left), Parser::parse($right)) === -1 ? $i + 1 : 0;
        }

        echo $sum;
    }
}
