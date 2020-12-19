<?php
declare(strict_types = 1);
interface OutputDirectoryManagerInterface
{
    public function clear(string $dirName);
    public function prepare(string $dirName);
}