<?php
declare(strict_types = 1);
interface FileLineInterface
{
    public function getRow(): int;
    public function getContent(): string;
}