<?php
declare(strict_types = 1);
interface LineFormatterInterface
{
    public function removeVersioning(string $line);
}