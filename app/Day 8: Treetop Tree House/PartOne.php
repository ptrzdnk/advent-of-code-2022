<?php declare(strict_types = 1);

namespace TreetopTreeHouse;

use Solution;

class PartOne implements Solution
{
    public function run(): void
    {
        $input = file(__DIR__ . '/input', FILE_IGNORE_NEW_LINES);

        $trees = 0;

        foreach ($input as $y => $row) {
            foreach (str_split($row) as $x => $tree) {
                $trees += (int) (
                    $this->visibleInRow($input, (int) $x, $y)
                    || $this->visibleInCol($input, (int) $x, $y)
                );
            }
        }

        echo $trees;
    }


    private function visibleInRow(array $input, int $x, int $y): bool
    {
        $row = str_split($input[$y]);

        return $this->visibleAmong($row, $x);
    }


    private function visibleInCol(array $input, int $x, int $y): bool
    {
        $col = [];

        foreach ($input as $row) {
            $col[] = $row[$x];
        }

        return $this->visibleAmong($col, $y);
    }


    private function visibleAmong(array $group, int $treePosition): bool
    {
        $tree = $group[$treePosition];

        return $this->visibleNextTo(array_slice($group, 0, $treePosition), $tree)
            || $this->visibleNextTo(array_slice($group, $treePosition + 1), $tree);
    }


    private function visibleNextTo(array $row, string $houseTree): bool
    {
        foreach ($row as $tree) {
            if ($tree >= $houseTree) {
                return false;
            }
        }

        return true;
    }
}
