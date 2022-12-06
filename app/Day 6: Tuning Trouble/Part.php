<?php declare(strict_types = 1);

namespace TuningTrouble;

use Solution;

abstract class Part implements Solution
{
    protected int $u;


    public function run(): void
    {
        $input = file_get_contents(__DIR__ . '/input');

        $i = -1;

        do {
            $w = substr($input, ++$i, $this->u);
        } while (strlen($w) !== strlen(count_chars($w, 3)));

        echo $i + $this->u;
    }
}
