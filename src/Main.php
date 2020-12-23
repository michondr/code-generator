<?php

declare(strict_types = 1);

use FileHandler;
use LineVersionTransformer;

class Main
{

    private FileHandler $fileHandler;
    private FilePreparer $filePreparer;
    private LineVersionTransformer $lineVersionTransformer;
    private VersionFiller $versionFiller;
    private VersionWriter $versionWriter;
    private OutputDirectoryManager $directoryManager;

    public function __construct(
        FileHandler $fileHandler,
        FilePreparer $filePreparer,
        LineVersionTransformer $lineVersionTransformer,
        VersionFiller $versionFiller,
        VersionWriter $versionWriter,
        OutputDirectoryManager $directoryManager
    )
    {
        $this->fileHandler = $fileHandler;
        $this->filePreparer = $filePreparer;
        $this->lineVersionTransformer = $lineVersionTransformer;
        $this->versionFiller = $versionFiller;
        $this->versionWriter = $versionWriter;
        $this->directoryManager = $directoryManager;
    }

    public function run(string $inputFile, string $outputLocation)
    {
        $lineList = $this->fileHandler->splitFileToLines($this->fileHandler->getFileLines($inputFile));

        /** @var Line[][] $versionList */
        $versionList = [];
        $versionCount = 0;

        foreach ($lineList->getLines() as $line) {
            $trasformedLine = $this->lineVersionTransformer->transform($line);

            if ($trasformedLine->hasAddedIn() === true) {
                $versionList[$trasformedLine->getAddedIn()][] = $trasformedLine;
            }
            if ($trasformedLine->hasRemovedIn() === true) {
                $versionList[$trasformedLine->getRemovedIn()][] = $trasformedLine;
            }
            if ($trasformedLine->getHighestVersion() > $versionCount) {
                $versionCount = $trasformedLine->getHighestVersion();
            }
        }

        ksort($versionList);

        $this->directoryManager->prepare($outputLocation);
        $this->directoryManager->clear($outputLocation);

        $fileStructure = $this->filePreparer->prepareFileStructure($this->fileHandler->getFileRowCount($inputFile), $versionCount);
        $fileStructureFilled = $this->versionFiller->fillStructure($fileStructure, $versionList);

        $this->versionWriter->writeVersions($fileStructureFilled, $this->fileHandler->getFileType($inputFile), $outputLocation);
    }
}