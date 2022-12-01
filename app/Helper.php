<?php declare(strict_types = 1);

class Helper
{
    /**
     * @return array<int, array<int, int>>
     */
    public static function explodeToArrayOfArraysOfIntegers(string $stringToExplode, string $arrayDelimiter = "\n\n", string $valuesDelimiter = "\n"): array
    {
        $arrayOfArraysOfIntegers = [];

        foreach (explode($arrayDelimiter, $stringToExplode) as $values) {
            $arrayOfArraysOfIntegers[] = self::explodeToArrayOfIntegers($values, $valuesDelimiter);
        }

        return $arrayOfArraysOfIntegers;
    }


    /**
     * @return array<int, int>
     */
    public static function explodeToArrayOfIntegers(string $stringToExplode, string $valuesDelimiter = "\n"): array
    {
        $arrayOfIntegers = [];

        foreach (explode($valuesDelimiter, $stringToExplode) as $value) {
            $arrayOfIntegers[] = (int) $value;
        }

        return $arrayOfIntegers;
    }
}
