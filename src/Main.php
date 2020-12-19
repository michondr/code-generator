<?php

declare(strict_types = 1);

class Main
{
    public function run(string $inputFile, string $outputLocation)
    {
        $fileHandler = new FileHandler();
        $fileStructurePreparer = new FilePreparer();
        $lineTransformer = new LineVersionTransformer();
        $versionFiller = new VersionFiller();
        $versionWriter = new VersionWriter();
        $outputDirectoryManager = new OutputDirectoryManager();

        $lineList = $fileHandler->splitFileToLines($fileHandler->getFileLines($inputFile));

        /** @var Line[][] $versionList */
        $versionList = [];
        $versionCount = 0;

        foreach ($lineList->getLines() as $line) {
            $trasformedLine = $lineTransformer->transform($line);

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

        $outputDirectoryManager->prepare($outputLocation);
        $outputDirectoryManager->clear($outputLocation);

        $fileStructure = $fileStructurePreparer->prepareFileStructure($fileHandler->getFileRowCount($inputFile), $versionCount);
        $fileStructureFilled = $versionFiller->fillStructure($fileStructure, $versionList);

        $versionWriter->writeVersions($fileStructureFilled, $fileHandler->getFileType($inputFile), $outputLocation);
    }
}