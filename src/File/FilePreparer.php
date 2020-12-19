<?php

declare(strict_types = 1);

class FilePreparer
{
    public function prepareFileStructure(int $fileRowCount, int $versionCount)
    {
        $fileStructure = [];

        for ($n = 0; $n <= $versionCount; $n++) {
            for ($i = 0; $i < $fileRowCount; $i++) {
                $fileStructure[$n][$i] = '';
            }
        }

        return $fileStructure;
    }
}