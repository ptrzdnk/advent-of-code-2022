<?php declare(strict_types = 1);

namespace BeaconExclusionZone;

use Solution;

abstract class Part implements Solution
{
    protected function map(array $input, int $y): array
    {
        $sensors = [];

        foreach ($input as $line) {
            $line = str_replace(['Sensor at ', ': closest beacon is at', 'x=', 'y='], ['', ',', '', ''], $line);
            $line = explode(', ', $line);
            $line = array_map(static fn($l): int => (int) $l, $line);

            [$sX, $sY, $bX, $bY] = $line;

            $dsb = abs($bX - $sX) + abs($bY - $sY);
            $rdsb = $dsb - abs($sY - $y);

            if ($rdsb < 0) {
                continue;
            }

            $sensors[] = [$sX - $rdsb, $sX + $rdsb];
        }

        return $sensors;
    }


    protected function overlap(array$sensors): array
    {
        usort($sensors, static fn(array $a, array $b): bool => $a[0] > $b[0]);

        [$l, $h] = $sensors[0];

        $overlap = [];

        foreach ($sensors as $sensor) {
            if ($sensor[0] > $h) {
                $overlap[] = [$l, $h];
                [$l, $h] = $sensor;
            } else {
                $h = max($h, $sensor[1]);
            }
        }

        $overlap[] = [$l, $h];

        return $overlap;
    }
}
