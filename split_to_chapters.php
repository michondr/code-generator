<?php

declare(strict_types = 1);

require_once 'src/autoload.php';

if ($argv[1] === 'help') {
    echo "usage:\n";
    echo "run the app:\n";
    echo "   php split_to_chapters.php input_file output_location\n";
    echo "run tests:\n";
    echo "   ./phpunit --bootstrap src/autoload.php tests\n";
    die;
} else {
    $fileName = $argv[1];
    $outputLocation = $argv[2];
}

if (file_exists($fileName) === false) {
    throw new Exception(sprintf('unable to find file "%s"', $fileName));
}

if (is_dir($outputLocation) === false) {
    throw new Exception(sprintf('unable to locate directory "%s"', $outputLocation));
}

$main = new Main(
    new FileHandler(),
    new FilePreparer(),
    new LineVersionTransformer(
        new LineFormatter(),
        new RegexExtractor()
    ),
    new VersionFiller(),
    new VersionWriter(),
    new OutputDirectoryManager()
);
$main->run($fileName, $outputLocation);