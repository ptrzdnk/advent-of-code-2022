<?php declare(strict_types = 1);

namespace BeaconExclusionZone;

class PartOne extends Part
{
    private const Y = 2000000;


    public function run(): void
    {
        $input = file(__DIR__ . '/input', FILE_IGNORE_NEW_LINES);

        $sensors = $this->map($input, self::Y);

        $count = 0;

        foreach ($this->overlap($sensors) as $sensor) {
            $count += abs($sensor[0]) + abs($sensor[1]);
        }

        echo $count;
    }
}
