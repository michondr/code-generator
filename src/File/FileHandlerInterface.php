<?php
declare(strict_types = 1);
interface FileHandlerInterface
{
    public function splitFileToLines(array $fileLines): FileLineList;
    public function getFileLines(string $fileName);
    public function getFileRowCount(string $fileName): int;
    public function getFileType(string $fileName): string;
}