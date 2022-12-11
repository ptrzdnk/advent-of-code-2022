<?php declare(strict_types = 1);

namespace TreetopTreeHouse;

use Solution;

class PartTwo implements Solution
{
    public function run(): void
    {
        $input = file(__DIR__ . '/input', FILE_IGNORE_NEW_LINES);

        $score = 0;

        foreach ($input as $y => $row) {
            foreach (str_split($row) as $x => $tree) {
                $score = max(
                    $score,
                    $this->scoreInRow($input, (int) $x, $y)
                    * $this->scoreInCol($input, (int) $x, $y)
                );
            }
        }

        echo $score;
    }


    private function scoreInRow(array $input, int $x, int $y): int
    {
        $row = str_split($input[$y]);

        return $this->scoreAmong($row, $x);
    }


    private function scoreInCol(array $input, int $x, int $y): int
    {
        $col = [];

        foreach ($input as $row) {
            $col[] = $row[$x];
        }

        return $this->scoreAmong($col, $y);
    }


    private function scoreAmong(array $group, int $treePosition): int
    {
        $tree = $group[$treePosition];

        return $this->scoreNextTo(array_reverse(array_slice($group, 0, $treePosition)), $tree)
            * $this->scoreNextTo(array_slice($group, $treePosition + 1), $tree);
    }


    private function scoreNextTo(array $row, string $houseTree): int
    {
        $i = 0;

        foreach ($row as $tree) {
            $i++;

            if ($tree >= $houseTree) {
                break;
            }
        }

        return $i;
    }
}
