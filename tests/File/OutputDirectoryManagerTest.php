<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;

class OutputDirectoryManagerTest extends TestCase
{
    private string $dirName;
    private OutputDirectoryManager $directoryManager;

    public function setUp(): void
    {
        $this->dirName = __DIR__.'/foo';
        $this->directoryManager = new OutputDirectoryManager();

        mkdir($this->dirName);
        touch($this->dirName . '/bar.txt');
        touch($this->dirName . '/baz.txt');
    }

    public function tearDown(): void
    {
        rmdir($this->dirName);
    }

    public function testClear()
    {
        $this->directoryManager->clear($this->dirName);

        self::assertEmpty(glob($this->dirName.'/*'));
    }
}