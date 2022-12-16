<?php declare(strict_types = 1);

namespace RegolithReservoir;

class Renderer
{
    public static function render(array $rocks, array $sands, string $filename, int $minX, int $maxX): void
    {
        $canvas = array_fill(0, 170, array_fill($minX, $maxX - $minX, '.'));

        $canvas[0][500] = '+';

        foreach ($rocks as $rock) {
            [$x, $y] = $rock;
            $canvas[$y][$x] = '#';
        }

        foreach ($sands as $sand) {
            [$x, $y] = $sand;
            $canvas[$y][$x] = 'o';
        }

        $data = implode("\n", array_map(static fn(array $row): string => implode('', $row), $canvas));

        file_put_contents($filename, $data);
    }
}
