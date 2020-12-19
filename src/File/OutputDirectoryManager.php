<?php

declare(strict_types = 1);

class OutputDirectoryManager
{
    public function clear(string $dirName)
    {
        foreach (glob($dirName . '/*') as $file) {
            unlink($file);
        }
    }

    public function prepare(string $dirName)
    {
        if (is_dir($dirName)) {
            return;
        }

        throw new Exception('directory does not ');
    }
}