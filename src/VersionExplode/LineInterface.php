<?php
declare(strict_types = 1);
interface LineInterface
{
    public function getContent(): string;
    public function getAddedIn(): ?int;
    public function hasAddedIn(): bool;
    public function getRemovedIn(): int;
    public function hasRemovedIn(): bool;
    public function getLineNumber(): int;
    public function getLineIndex(): int;
    public function getHighestVersion(): int;
}