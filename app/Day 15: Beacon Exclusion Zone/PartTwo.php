<?php declare(strict_types = 1);

namespace BeaconExclusionZone;

class PartTwo extends Part
{
    public function run(): void
    {
        $input = file(__DIR__ . '/input', FILE_IGNORE_NEW_LINES);

        for ($y = 4000000; $y >= 0; $y--) {
            $sensors = $this->map($input, $y);
            $overlap = $this->overlap($sensors);

            if (count($overlap) > 1) {
                $x = $overlap[0][1] + 1;
                echo 4000000 * $x + $y; // 4000000 * 3172756 + 2767556

                break;
            }
        }
    }
}
