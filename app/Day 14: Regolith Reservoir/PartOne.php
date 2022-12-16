<?php declare(strict_types = 1);

namespace RegolithReservoir;

use Solution;

class PartOne implements Solution
{
    public function run(): void
    {
        $input = file(__DIR__ . '/input', FILE_IGNORE_NEW_LINES);

        $rocks = Parser::parse($input);
        $sands = [];

        Renderer::render($rocks, $sands, __DIR__ . '/outputPartOneBefore', 470, 540);

        $sand = [500, 0];

        while (true) {
            [$x, $y] = $sand;

            if ($y >= 168) {
                break;
            }

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

        Renderer::render($rocks, $sands, __DIR__ . '/outputPartOneAfter', 470, 540);

        echo count($sands);
    }
}
