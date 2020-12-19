<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;

class RegexExtractorTest extends TestCase
{

    private RegexExtractor $extractor;

    protected function setUp(): void
    {
        $this->extractor = new RegexExtractor();
    }

    /**
     * @param string $regexPattern
     * @param string $context
     * @param string $expectedOutput
     *
     * @dataProvider provideData
     */
    public function testExtract(string $regexPattern, string $context, string $expectedOutput)
    {
        self::assertEquals(
            $expectedOutput,
            $this->extractor->extract($regexPattern, $context)
        );
    }

    public function provideData()
    {
        return [
            [
                '//~([\+\-\ \d]+)*$',
                '//declare(strict_types = 0); //~ +1 -2',
                ' +1 -2'
            ]
        ];
    }
}