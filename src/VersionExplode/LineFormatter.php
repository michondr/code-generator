<?php

declare(strict_types = 1);

class LineFormatter implements LineFormatterInterface
{

    public function removeVersioning(string $line)
    {
        if (strpos($line, '//~') !== false) {
            return substr($line, 0, strpos($line, ' //~'));
        }

        return $line;
    }

}