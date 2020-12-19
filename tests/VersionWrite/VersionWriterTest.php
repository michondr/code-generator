<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;

class VersionWriterTest extends TestCase
{
    private VersionWriter $writer;

    protected function setUp(): void
    {
        $this->writer = new VersionWriter();
    }

    /**
     * @param array $fileStructure
     * @param string $fileType
     * @param string $outputLocation
     * @param string $outputFileContent
     *
     * @dataProvider provideData
     */
    public function testWriteVersions(array $fileStructure, string $fileType, string $outputLocation, string $outputFileContent)
    {
        $this->writer->writeVersions($fileStructure, $fileType, $outputLocation);
        $createdFile = $outputLocation . '/2' . $fileType;

        self::assertEquals(
            file_get_contents($createdFile),
            $outputFileContent
        );

        unlink($createdFile);
    }

    public function provideData()
    {
        return [
            [
                [
                    2 => [
                        0 => '<?php',
                        1 => 'echo "done";',
                        2 => 'declare(strict_types = 1);',
                    ]
                ],
                '.csv',
                __DIR__,
                "<?php\necho \"done\";\ndeclare(strict_types = 1);\n",
            ],
        ];
    }

}