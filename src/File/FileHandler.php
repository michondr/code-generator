<?php

declare(strict_types = 1);

class FileHandler implements FileHandlerInterface
{
    public function splitFileToLines(array $fileLines): FileLineList
    {
        $linesToHandle = [];
        foreach ($fileLines as $index => $line) {
            $lineObj = new FileLine(
                $index,
                $line
            );
            $linesToHandle[] = $lineObj;
        }

        return new FileLineList($linesToHandle);
    }

    public function getFileLines(string $fileName)
    {
        $contents = file_get_contents($fileName);
        return explode("\n", $contents);
    }

    public function getFileRowCount(string $fileName): int
    {
        return count($this->getFileLines($fileName));
    }

    public function getFileType(string $fileName): string
    {
        return substr($fileName, strpos($fileName, '.'));
    }
}