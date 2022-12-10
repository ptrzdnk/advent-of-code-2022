<?php declare(strict_types = 1);

namespace NoSpaceLeftOnDevice;

use Solution;

class PartOne implements Solution
{
    private array $dir = [];

    private array $p = [];

    private array $sums = [];


    public function run(): void
    {
        $input = file(__DIR__ . '/input', FILE_IGNORE_NEW_LINES);

        foreach ($input as $log) {
            $log = explode(' ', $log);

            if ($log[0] === '$') {
                if ($log[1] === 'cd') {
                    if ($log[2] === '/') {
                        $this->p = [];
                    } elseif ($log[2] === '..') {
                        array_pop($this->p);
                    } else {
                        $this->p[] = $log[2];
                    }
                }
            } elseif ($log[0] === 'dir') {
                $this->add($log[1], []);
            } else {
                $this->add($log[1], (int) $log[0]);
            }
        }

        $this->sum($this->dir);

        echo $this->resolve();
    }


    private function add(string $name, $v): void
    {
        $dir = [$name => $v];

        foreach (array_reverse($this->p) as $p) {
            $dir[$p] = $dir;

            foreach ($dir as $x => $xx) {
                if ($x !== $p) {
                    unset ($dir[$x]);
                }
            }
        }

        $this->dir = array_merge_recursive($this->dir, $dir);
    }


    private function sum(array $dir): int
    {
        $sum = 0;

        foreach ($dir as $d) {
            if (is_array($d)) {
                $sum += $this->sum($d);
            } else {
                $sum += $d;
            }
        }

        $this->sums[] = $sum;

        return $sum;
    }

    private function resolve(): int
    {
        $a = 0;

        foreach ($this->sums as $sum) {
            if ($sum <= 100000) {
                $a += $sum;
            }
        }

        return $a;
    }
}
