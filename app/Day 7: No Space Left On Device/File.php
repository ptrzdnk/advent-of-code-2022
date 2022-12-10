<?php declare(strict_types = 1);

namespace NoSpaceLeftOnDevice;

class File
{
    private string $name;

    private int $size;


    public function __construct(
        string $name,
        int $size,
    ) {
        $this->name = $name;
        $this->size = $size;
    }


    public function getName(): string
    {
        return $this->name;
    }


    public function getSize(): int
    {
        return $this->size;
    }
}
