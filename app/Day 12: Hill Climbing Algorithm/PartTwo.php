<?php declare(strict_types = 1);

namespace HillClimbingAlgorithm;

class PartTwo extends Part
{
    public function run(): void
    {
        $input = file(__DIR__ . '/input', FILE_IGNORE_NEW_LINES);

        $paths = [];

        for ($y = 0; $y <= 40; $y++) {
            if ($y === 0) {
                $input[20] = str_replace('S', 'a', $input[20]);
            } else {
                $input[$y - 1] = str_replace('S', 'a', $input[$y - 1]);
            }

            $input[$y] = 'S' . substr($input[$y], 1);

            $this->init($input);

            $paths[] = $this->findPath();
        }

        usort($paths, static fn(array $a, array $b) => count($a) <=> count($b));

        $path = reset($paths);

        Renderer::render($path, __DIR__ . '/outputPartTwo');

        echo count($path);
    }
}
