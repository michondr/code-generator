<?php

declare(strict_types = 1);

class FileLine
{

    private int $row;
    private string $content;

    public function __construct(
        int $rowIndex,
        string $content
    )
    {
        $this->row = $rowIndex+1;
        $this->content = $content;
    }

    public function getRow(): int
    {
        return $this->row;
    }

    public function getContent(): string
    {
        return $this->content;
    }

}