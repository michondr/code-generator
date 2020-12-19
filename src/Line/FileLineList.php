<?php

declare(strict_types = 1);

class FileLineList implements FileLineListInterface
{

    private array $lines;

    public function __construct(array $lines)
    {

        $this->lines = $lines;
    }

    public function getLines(): array
    {
        return $this->lines;
    }

}