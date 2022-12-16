<?php declare(strict_types = 1);

namespace HillClimbingAlgorithm;

class PartOne extends Part
{
    public function run(): void
    {
        $input = file(__DIR__ . '/input', FILE_IGNORE_NEW_LINES);

        $this->init($input);

        $path = $this->findPath();

        Renderer::render($path, __DIR__ . '/outputPartOne');

        echo count($path);
    }
}
