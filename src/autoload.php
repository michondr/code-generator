<?php

declare(strict_types = 1);

include 'Main.php';

foreach (glob('src/*/*.php') as $file) {
    include $file;
}
foreach (glob('src/*/*/*.php') as $file) {
    include $file;
}

function dd($data)
{
    var_dump($data);
    die;
}

//spl_autoload_register(function ($sClass) {
//    // Hack to remove namespace and backslash
//    $sClass = str_replace([__NAMESPACE__ . '\\', '\\'], DIRECTORY_SEPARATOR, $sClass);
//
//    $fileLocation = __DIR__.str_replace('Michondr', '', $sClass) . '.php';
//
//    if (is_file($fileLocation)) {
//        require_once $fileLocation;
//    }
//});