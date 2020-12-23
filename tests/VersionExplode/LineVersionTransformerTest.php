<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;

class LineVersionTransformerTest extends TestCase
{
    private LineVersionTransformer $transformer;

    protected function setUp(): void
    {
        $this->transformer = new LineVersionTransformer(
            new LineFormatter(),
            new RegexExtractor()
        );
    }

    /**
     * @param FileLine $line
     * @param Line $expectedLine
     *
     * @dataProvider provideData
     */
    public function testTransform(FileLine $line, Line $expectedLine)
    {
        self::assertEquals(
            $expectedLine,
            $this->transformer->transform($line)
        );
    }

    public function provideData()
    {
        return [
            [
                new FileLine(1, '<?php'),
                new Line(2, '<?php', null, null),
            ],
            [
                new FileLine(1, '//declare(strict_types = 0); //~ +1 -2'),
                new Line(2, '//declare(strict_types = 0);', 1, 2),
            ],
            [
                new FileLine(12, '$outputDirectoryCleaner = new OutputDirectoryCleaner(); //~ +3'),
                new Line(13, '$outputDirectoryCleaner = new OutputDirectoryCleaner();', 3, null),
            ],
            [
                new FileLine(12, '$outputDirectoryCleaner = new OutputDirectoryCleaner(); //~ -4'),
                new Line(13, '$outputDirectoryCleaner = new OutputDirectoryCleaner();', null, 4),
            ],
        ];
    }

}