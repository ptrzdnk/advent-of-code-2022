<?php declare(strict_types = 1);

namespace RegolithReservoir;

class Parser
{
    public static function parse(array $input): array
    {
        $rocks = [];

        foreach ($input as $line) {
            $line = explode(' -> ', $line);

            $breaks = [];
            $j = 0;

            foreach ($line as $xy) {
                [$x, $y] = explode(',', $xy);

                $breaks[] = [(int) $x, (int) $y];
                $j++;
            }

            for ($i = 0; $i < $j - 1; $i++) {
                [$x1, $y1] = $breaks[$i];
                [$x2, $y2] = $breaks[$i + 1];

                if ($x1 === $x2) {
                    foreach (range($y1, $y2) as $y) {
                        $rocks["$x1-$y"] = [$x1, $y];
                    }
                } else {
                    foreach (range($x1, $x2) as $x) {
                        $rocks["$x-$y1"] = [$x, $y1];
                    }
                }
            }
        }

        return $rocks;
    }
}
