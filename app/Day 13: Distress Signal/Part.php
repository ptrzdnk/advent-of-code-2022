<?php declare(strict_types = 1);

namespace DistressSignal;

use Solution;

abstract class Part implements Solution
{
    protected function compare($left, $right): int
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

        foreach ($left as $i => $l) {
            if (!isset($right[$i])) {
                return 1;
            }

            $compare = $this->compare($left[$i], $right[$i]);

            if ($compare !== 0) {
                return $compare;
            }
        }

        return $this->compare(count($left), count($right));
    }


    protected function parse($value)
    {
        if (is_numeric($value)) {
            return (int) $value;
        }

        if (is_array($value)) {
            $els = [];
            $int = '';

            foreach ($value as $el) {
                if (is_numeric($el)) {
                    $int .= $el;
                }

                if (is_array($el)) {
                    $els[] = $el;
                }

                if (($el === ',' || $el === ']') && $int !== '') {
                    $els[] = $this->parse($int);
                    $int = '';
                }
            }

            return $els;
        }

        if (is_string($value)) {
            $value = str_split($value);
        }

        $buffer = [];

        while (in_array('[', $value, true)) {
            foreach ($value as $i => $ch) {
                if ($ch === '[') {
                    $open = $i;
                    $buffer = [];
                }

                $buffer[] = $ch;

                if (in_array('[', $buffer, true) && $ch === ']') {
                    foreach (range($open, $i - 1) as $u) {
                        unset($value[$u]);
                    }
                    $value[$i] = $this->parse($buffer);
                    $buffer = [];
                }
            }
        }

        return array_values($value);
    }
}
