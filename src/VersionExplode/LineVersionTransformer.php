<?php

declare(strict_types = 1);

class LineVersionTransformer implements LineVersionTransformerInterface
{

    private LineFormatter $lineFormatter;
    private RegexExtractor $regexExtractor;

    public function __construct()
    {
        $this->lineFormatter = new LineFormatter();
        $this->regexExtractor = new RegexExtractor();
    }

    public function transform(FileLine $line): Line
    {
        $content = $line->getContent();

        try {
            $versionedLine = $this->regexExtractor->extract('//~([\+\-\ \d]+)*$', $content);
        } catch (UnableToMatchException $e) {
            return new Line($line->getRow(), $this->lineFormatter->removeVersioning($content), 0, null);
        }

        $lineAddedInfo = explode(' ', trim($versionedLine));

        $isAddedIn = null;
        $isRemovedIn = null;

        foreach ($lineAddedInfo as $item) {
            $sign = $this->regexExtractor->extract('([\+\-])', $item);
            $version = (int) $this->regexExtractor->extract('([\d]+)', $item);

            if ($sign === '+') {
                $isAddedIn = $version;
            } else {
                $isRemovedIn = $version;
            }
        }

        return new Line($line->getRow(), $this->lineFormatter->removeVersioning($line->getContent()), $isAddedIn, $isRemovedIn);

    }
}