<?php declare(strict_types = 1);

namespace DistressSignal;

class Comparer
{
    public static function compare($left, $right): int
    {
        if (is_int($left) && is_int(($right))) {
            return $left <=> $right;
        }

        if (!is_array($left)) {
            $left = [$left];
        }

        if (!is_array($right)) {
            $right = [$right];
        }

        foreach ($left as $i => $v) {
            if (!isset($right[$i])) {
                return 1;
            }

            $compare = self::compare($left[$i], $right[$i]);

            if ($compare !== 0) {
                return $compare;
            }
        }

        return self::compare(count($left), count($right));
    }
}
