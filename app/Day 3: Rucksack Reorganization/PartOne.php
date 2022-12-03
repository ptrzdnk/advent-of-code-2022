<?php declare(strict_types = 1);

namespace RucksackReorganization;

use Solution;

class PartOne implements Solution
{
    private const PRIORITIES = '_abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';


    public function run(): void
    {
        $input = file(__DIR__ . '/input', FILE_IGNORE_NEW_LINES);

        $priorities = [];

        foreach ($input as $rucksackContents) {
            [$compartmentOne, $compartmentTwo] = array_chunk(str_split($rucksackContents), strlen($rucksackContents) / 2);

            foreach (array_unique(array_intersect($compartmentOne, $compartmentTwo)) as $share) {
                $priorities[] = strpos(self::PRIORITIES, $share);
            }
        }

        echo array_sum($priorities);
    }
}
