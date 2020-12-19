<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;

class VersionFillerTest extends TestCase
{
    private VersionFiller $filler;

    protected function setUp(): void
    {
        $this->filler = new VersionFiller();
    }

    /**
     * @param array $fileStructure
     * @param array $versionList
     * @param array $expectedOutput
     *
     * @dataProvider provideData
     */
    public function testFillStructure(array $fileStructure, array $versionList, array $expectedOutput)
    {
        self::assertEquals(
            $expectedOutput,
            $this->filler->fillStructure($fileStructure, $versionList)
        );
    }

    public function provideData()
    {
        return [
            [
                [],
                [],
                [],
            ],
            [
                [
                    0 => [
                        0 => '',
                        1 => '',
                        2 => '',
                    ],
                    1 => [
                        0 => '',
                        1 => '',
                        2 => '',
                    ],
                    2 => [
                        0 => '',
                        1 => '',
                        2 => '',
                    ],
                ],
                [
                    0 => [
                        new Line(1, '<?php', 0, null),
                    ],
                    1 => [
                        new Line(2, 'declare(strict_types = 1);', 2, 1),
                        new Line(2, 'echo "done";', 1, null),
                    ],
                    2 => [
                        new Line(3, 'declare(strict_types = 1);', 2, 1),

                    ],
                ],
                [
                    0 => [
                        0 => '<?php',
                        1 => '',
                        2 => '',
                    ],
                    1 => [
                        0 => '<?php',
                        1 => 'echo "done";',
                        2 => '',
                    ],
                    2 => [
                        0 => '<?php',
                        1 => 'echo "done";',
                        2 => 'declare(strict_types = 1);',
                    ],
                ],
            ],
        ];
    }
}