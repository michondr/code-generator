<?php
declare(strict_types = 1);
interface RegexExtractorInterface
{
    public function extract(string $regexPattern, string $context): string;
}