<?php

declare(strict_types = 1);

class VersionWriter implements VersionWriterInterface
{
    public function writeVersions(array $fileStructure, string $fileType, string $outputLocation)
    {
        foreach ($fileStructure as $fileVersionName => $rows) {
            foreach ($rows as $rowIndex => $row) {
                $this->appendToFile($outputLocation, $fileType, $fileVersionName, $row);
            }
        }
    }

    private function appendToFile(string $outputLocation, string $fileType, int $versionName, string $line)
    {
        file_put_contents(
            $outputLocation . '/' . $versionName . $fileType,
            $line . "\n",
            FILE_APPEND
        );
    }
}