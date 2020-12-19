<?php

declare(strict_types = 1);

class Line
{

    private string $content;
    private int $lineNumber;
    private ?int $addedIn;
    private ?int $removedIn;

    public function __construct(
        int $lineNumber,
        string $content,
        ?int $addedIn,
        ?int $removedIn
    )
    {
        $this->content = $content;
        $this->addedIn = $addedIn;
        $this->removedIn = $removedIn;
        $this->lineNumber = $lineNumber;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getAddedIn(): ?int
    {
        return $this->addedIn;
    }

    public function hasAddedIn(): bool
    {
        return $this->addedIn !== null;
    }

    public function getRemovedIn(): int
    {
        return $this->removedIn;
    }

    public function hasRemovedIn(): bool
    {
        return $this->removedIn !== null;
    }

    public function getLineNumber(): int
    {
        return $this->lineNumber;
    }

    public function getLineIndex(): int
    {
        return $this->lineNumber - 1;
    }

    public function getHighestVersion(): int
    {
        return max(
            [
                $this->addedIn ?? 0,
                $this->removedIn ?? 0,
            ]
        );
    }

}