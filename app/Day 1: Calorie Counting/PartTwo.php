<?php declare(strict_types = 1);

namespace CalorieCounting;

use Helper;
use Solution;

class PartTwo implements Solution
{
    public function run(): void
    {
        $input = Helper::explodeToArrayOfArraysOfIntegers(file_get_contents(__DIR__ . '/input'));

        $caloriesCurrentElfIsCarrying = 0;
        $theMostCaloriesAnyElfIsCarrying = $caloriesCurrentElfIsCarrying;
        $secondMostCaloriesAnyElfIsCarrying = $caloriesCurrentElfIsCarrying;
        $thirdMostCaloriesAnyElfIsCarrying = $caloriesCurrentElfIsCarrying;

        foreach ($input as $foodCurrentElfIsCarrying) {
            $caloriesCurrentElfIsCarrying = array_sum($foodCurrentElfIsCarrying);

            if ($caloriesCurrentElfIsCarrying > $theMostCaloriesAnyElfIsCarrying) {
                $thirdMostCaloriesAnyElfIsCarrying = $secondMostCaloriesAnyElfIsCarrying;
                $secondMostCaloriesAnyElfIsCarrying = $theMostCaloriesAnyElfIsCarrying;
                $theMostCaloriesAnyElfIsCarrying = $caloriesCurrentElfIsCarrying;
            }
        }

        $totalCaloriesTopThreeElvesAreCarrying = $theMostCaloriesAnyElfIsCarrying + $secondMostCaloriesAnyElfIsCarrying + $thirdMostCaloriesAnyElfIsCarrying;

        echo $totalCaloriesTopThreeElvesAreCarrying;
    }
}
