<?php
declare(strict_types = 1);
interface VersionWriterInterface
{
    public function writeVersions(array $fileStructure, string $fileType, string $outputLocation);
}