<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;

class FilePreparerTest extends TestCase
{
    private FilePreparer $filePreparer;

    public function setUp(): void
    {
        $this->filePreparer = new FilePreparer();
    }

    /**
     * @param int $fileRowCount
     * @param int $versionCount
     * @param array $expectedOutput
     *
     * @dataProvider provideData
     */
    public function testPrepareFileStructure(int $fileRowCount, int $versionCount, array $expectedOutput)
    {
        self::assertEquals(
            $expectedOutput,
            $this->filePreparer->prepareFileStructure($fileRowCount, $versionCount)
        );
    }

    public function provideData()
    {
        return [
            'first base version, two for output' => [
                4,
                2,
                [
                    [
                        '',
                        '',
                        '',
                        '',
                    ],
                    [
                        '',
                        '',
                        '',
                        '',
                    ],
                    [
                        '',
                        '',
                        '',
                        '',
                    ],
                ],
            ],
        ];
    }
}