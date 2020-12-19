<?php

declare(strict_types = 1);

class VersionFiller implements VersionFillerInterface
{
    public function fillStructure(array $fileStructure, array $versionList)
    {
        /** @var Line $versionLine */

        foreach ($fileStructure as $fileVersionName => $rows) {
            foreach ($versionList as $currentVersionName => $versionLines) {
                if ($fileVersionName < $currentVersionName) {
                    continue;
                }

                foreach ($versionLines as $versionLine) {
                    if ($versionLine->hasAddedIn() === true && $versionLine->getAddedIn() === $currentVersionName) {
                        $fileStructure[$fileVersionName][$versionLine->getLineIndex()] = ltrim($versionLine->getContent(), '/');
                    }
                    if ($versionLine->hasRemovedIn() === true && $versionLine->getRemovedIn() === $currentVersionName) {
                        $fileStructure[$fileVersionName][$versionLine->getLineIndex()] = '';
                    }
                }

            }
        }

        return $fileStructure;
    }
}