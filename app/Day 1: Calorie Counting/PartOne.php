<?php declare(strict_types = 1);

namespace CalorieCounting;

use Helper;
use Solution;

class PartOne implements Solution
{
    public function run(): void
    {
        $input = Helper::explodeToArrayOfArraysOfIntegers(file_get_contents(__DIR__ . '/input'));

        $caloriesCurrentElfIsCarrying = 0;
        $theMostCaloriesAnyElfIsCarrying = $caloriesCurrentElfIsCarrying;

        foreach ($input as $foodCurrentElfIsCarrying) {
            $caloriesCurrentElfIsCarrying = array_sum($foodCurrentElfIsCarrying);

            if ($caloriesCurrentElfIsCarrying > $theMostCaloriesAnyElfIsCarrying) {
                $theMostCaloriesAnyElfIsCarrying = $caloriesCurrentElfIsCarrying;
            }
        }

        echo $theMostCaloriesAnyElfIsCarrying;
    }
}
