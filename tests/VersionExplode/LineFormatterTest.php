<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;

class LineFormatterTest extends TestCase
{

    private LineFormatter $lineFormatter;

    protected function setUp(): void
    {
        $this->lineFormatter = new LineFormatter();
    }

    /**
     * @param string $input
     * @param string $expectedOutput
     * @dataProvider provideDataForRemoveVersioning
     */
    public function testRemoveVersioning(string $input, string $expectedOutput)
    {
        self::assertEquals(
            $expectedOutput,
            $this->lineFormatter->removeVersioning($input)
        );
    }

    public function provideDataForRemoveVersioning()
    {
        return [
            [
                '<?php',
                '<?php',
            ],
            [
                '//declare(strict_types = 0); //~ +1 -2',
                '//declare(strict_types = 0);',
            ],
        ];
    }

}