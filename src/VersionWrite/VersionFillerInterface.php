<?php
declare(strict_types = 1);
interface VersionFillerInterface
{
    public function fillStructure(array $fileStructure, array $versionList);
}