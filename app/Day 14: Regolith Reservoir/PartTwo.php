<?php declare(strict_types = 1);

namespace RegolithReservoir;

use Solution;

class PartTwo implements Solution
{
    public function run(): void
    {
        $input = file(__DIR__ . '/input', FILE_IGNORE_NEW_LINES);

        $input[] = '330,169 -> 670,169';

        $rocks = Parser::parse($input);
        $sands = [];

        Renderer::render($rocks, $sands, __DIR__ . '/outputPartTwoBefore', 330, 670);

        $sand = [500, 0];

        while (!isset($sands['500-0'])) {
            [$x, $y] = $sand;

            $d = $x . '-' . ($y + 1);
            $l = ($x - 1) . '-' . ($y + 1);
            $r = ($x + 1) . '-' . ($y + 1);

            if (isset($rocks[$d]) || isset($sands[$d])) {
                if (isset($rocks[$l]) || isset($sands[$l])) {
                    if (isset($rocks[$r]) || isset($sands[$r])) {
                        $sands["$x-$y"] = $sand;
                        $sand = [500, 0];
                    } else {
                        $sand = [$x + 1, $y + 1];
                    }
                } else {
                    $sand = [$x - 1, $y + 1];
                }
            } else {
                $sand = [$x, $y + 1];
            }
        }

        Renderer::render($rocks, $sands, __DIR__ . '/outputPartTwoAfter', 330, 670);

        echo count($sands);
    }
}
