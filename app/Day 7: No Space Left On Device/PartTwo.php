<?php declare(strict_types = 1);

namespace NoSpaceLeftOnDevice;

use Solution;

class PartTwo implements Solution
{
    private const DISK_SPACE = 70000000;
    private const DISK_SPACE_REQUIRED = 30000000;
    private const DISK_SPACE_MAX_USAGE = self::DISK_SPACE - self::DISK_SPACE_REQUIRED;


    public function run(): void
    {
        $input = file(__DIR__ . '/input', FILE_IGNORE_NEW_LINES);

        $root = new Dir('/', null);
        $dir = $root;

        foreach ($input as $log) {
            $log = explode(' ', $log);

            if ($log[0] === '$') {
                if ($log[1] === 'cd') {
                    if ($log[2] === '/') {
                        $dir = $root;
                    } elseif ($log[2] === '..') {
                        $dir = $dir->getParent();
                    } else {
                        $dir = $dir->getSubDir($log[2]);
                    }
                }
            } elseif ($log[0] === 'dir') {
                $dir->addSubDir($log[1]);
            } else {
                $dir->addFile($log[1], (int) $log[0]);
            }
        }

        $subDirs = $root->getSubDirs();
        $rootSize = $root->getSize();

        $a = self::DISK_SPACE_REQUIRED;

        foreach ($subDirs as $subDir) {
            $subDirSize = $subDir->getSize();

            if ($rootSize - $subDirSize < self::DISK_SPACE_MAX_USAGE) {
                $a = min($a, $subDirSize);
            }
        }

        echo $a;
    }
}
