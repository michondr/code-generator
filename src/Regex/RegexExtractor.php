<?php

declare(strict_types = 1);

class RegexExtractor implements RegexExtractorInterface
{
    private const REGEX_SUCCESS = 1;
    private const REGEX_NOT_MATCHED = 0;
    private const REGEX_FAIL = false;

    public function extract(string $regexPattern, string $context): string
    {
        $result = preg_match('#' . $regexPattern . '#', $context, $matches);

        if ($result === self::REGEX_FAIL) {
            throw new UnableToMatchException(sprintf('pattern "%s" caused failure in "%s"', $regexPattern, $context));
        }

        if ($result === self::REGEX_NOT_MATCHED) {
            throw new UnableToMatchException(sprintf('pattern "%s" not matched in "%s"', $regexPattern, $context));
        }

        if ($result === self::REGEX_SUCCESS && isset($matches[1]) === false) {
            throw new MatchingGroupNotFoundException(sprintf('pattern "%s" returned no data from capturing group in "%s"', $regexPattern, $context));
        }

        return $matches[1];
    }
}