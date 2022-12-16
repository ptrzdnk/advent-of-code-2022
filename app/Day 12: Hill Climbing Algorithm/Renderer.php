<?php declare(strict_types = 1);

namespace HillClimbingAlgorithm;

class Renderer
{
    /**
     * @param array<Square> $path
     */
    public static function render(array $path, string $filename): void
    {
        $canvas = array_fill(1, 41, array_fill(1, 77, '.'));

        foreach ($path as $square) {
            $x = $square->getX();
            $y = $square->getY();
            $canvas[$y][$x] = Part::HEIGHTS[$square->getHeight()];
        }

        $data = implode("\n", array_map(static fn(array $row): string => implode('', $row), $canvas));

        file_put_contents($filename, $data);
    }
}
