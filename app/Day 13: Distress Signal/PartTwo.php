<?php declare(strict_types = 1);

namespace DistressSignal;

use Solution;

class PartTwo implements Solution
{
    private const DIVIDER_PACKET_2 = [[2]];
    private const DIVIDER_PACKET_6 = [[6]];


    public function run(): void
    {
        $input = file(__DIR__ . '/input', FILE_IGNORE_NEW_LINES);

        $input = array_filter($input);
        $input = array_map([Parser::class, 'parse'], $input);

        $input[] = self::DIVIDER_PACKET_2;
        $input[] = self::DIVIDER_PACKET_6;

        usort($input, [Comparer::class, 'compare']);

        $a = 0;

        foreach ($input as $i => $v) {
            if (Comparer::compare($v, self::DIVIDER_PACKET_2) === 0) {
                $a += $i + 1;
                break;
            }
        }

        foreach ($input as $i => $v) {
            if (Comparer::compare($v, self::DIVIDER_PACKET_6) === 0) {
                $a *= $i + 1;
                break;
            }
        }

        echo $a;
    }
}
