<?php
declare(strict_types = 1);
interface FilePreparerInterface
{
    public function prepareFileStructure(int $fileRowCount, int $versionCount);
}