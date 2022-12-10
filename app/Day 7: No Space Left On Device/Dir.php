<?php declare(strict_types = 1);

namespace NoSpaceLeftOnDevice;

class Dir
{
    private string $name;

    private ?Dir $parent;

    /**
     * @var array<Dir>
     */
    protected array $subDirs = [];

    /**
     * @var array<File>
     */
    protected array $files = [];


    public function __construct(
        string $name,
        ?Dir $parent,
    ) {
        $this->name = $name;
        $this->parent = $parent;
    }


    public function getName(): string
    {
        return $this->name;
    }


    public function getParent(): self
    {
        return $this->parent;
    }


    public function addSubDir(string $name): void
    {
        $this->subDirs[$name] = new Dir($name, $this);
    }


    public function getSubDir(string $name): Dir
    {
        return $this->subDirs[$name];
    }


    public function addFile(string $name, int $size): void
    {
        $this->files[$name] = new File($name, $size);
    }


    public function getSize(): int
    {
        $size = 0;

        foreach ($this->subDirs as $subDir) {
            $size += $subDir->getSize();
        }

        foreach ($this->files as $file) {
            $size += $file->getSize();
        }

        return $size;
    }


    /**
     * @return array<Dir>
     */
    public function getSubDirs(): array
    {
        $subDirs = [];

        foreach ($this->subDirs as $subDir) {
            foreach ($subDir->getSubDirs() as $subSubDir) {
                $subDirs[$subSubDir->getName()] = $subSubDir;
            }
        }

        return array_merge($subDirs, $this->subDirs);
    }
}
