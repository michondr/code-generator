<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;

class FileHandlerTest extends TestCase
{
    private FileHandler $fileHandler;

    public function setUp(): void
    {
        $this->fileHandler = new FileHandler();
    }

    /**
     * @param array $inputFileLines
     * @param FileLineList $expectedFileLineList
     *
     * @dataProvider provideDataForTestSplitFileToLines
     */
    public function testSplitFileToLines(array $inputFileLines, FileLineList $expectedFileLineList)
    {
        self::assertEquals(
            $expectedFileLineList,
            $this->fileHandler->splitFileToLines($inputFileLines)
        );
    }

    public function provideDataForTestSplitFileToLines()
    {
        return [
            [
                [
                    '<php',
                    '',
                    'declare(strict_types = 1);',
                ],
                new FileLineList(
                    [
                        new FileLine(0, '<php'),
                        new FileLine(1, ''),
                        new FileLine(2, 'declare(strict_types = 1);'),
                    ]
                ),
            ],
        ];
    }

    /**
     * @param string $inputFileName
     * @param string $expectedFileType
     *
     * @dataProvider provideDataForTestGetFileType
     */
    public function testGetFileType(string $inputFileName, string $expectedFileType)
    {
        self::assertEquals(
            $expectedFileType,
            $this->fileHandler->getFileType($inputFileName)
        );
    }

    public function provideDataForTestGetFileType()
    {
        return [
            [
                'some.txt',
                '.txt',
            ],
            [
                'src/autoload.php',
                '.php',
            ],
        ];
    }
}