<?php declare(strict_types = 1);

namespace CathodeRayTube;

use Solution;

class PartTwo implements Solution
{
    private string $sprite = '###.....................................';

    private string $image = '';

    private int $position = 0;


    public function run(): void
    {
        $input = file(__DIR__ . '/input', FILE_IGNORE_NEW_LINES);

        foreach ($input as $ins) {
            $this->writePixel();

            if ($ins === 'noop') {
                continue;
            }

            $this->writePixel();
            $this->resetSprite($ins);
        }

        echo $this->image;
    }


    private function writePixel(): void
    {
        if ($this->position % 40 === 0) {
            $this->image .= "\n";
        }

        $this->image .= $this->sprite[$this->position % 40];
        $this->position++;
    }


    private function resetSprite(string $ins): void
    {
        [, $s] = explode(' ', $ins);
        $s = (int) $s;

        $this->sprite = substr($this->sprite, -$s) . substr($this->sprite, 0, -$s);
    }
}
