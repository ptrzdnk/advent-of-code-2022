<?php declare(strict_types = 1);

namespace DistressSignal;

class Parser
{
    public static function parse($value)
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
                    $els[] = self::parse($int);
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
                    $value[$i] = self::parse($buffer);
                    $buffer = [];
                }
            }
        }

        return array_values($value);
    }
}
