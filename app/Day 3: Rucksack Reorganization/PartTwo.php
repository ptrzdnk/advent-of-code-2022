<?php declare(strict_types = 1);

namespace RucksackReorganization;

use Solution;

class PartTwo implements Solution
{
    private const PRIORITIES = '_abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';


    public function run(): void
    {
        $input = file(__DIR__ . '/input', FILE_IGNORE_NEW_LINES);

        $priorities = [];

        foreach (array_chunk($input, 3) as $group) {
            $badge = array_intersect(...array_map('str_split', $group));
            $priorities[] = strpos(self::PRIORITIES, reset($badge));
        }

        echo array_sum($priorities);
    }
}
