<?php

use Phalcon\Loader;

$loader = new Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerNamespaces([
    'Solved\Models'      => $config->application->modelsDir,
    'Solved\Controllers' => $config->application->controllersDir,
    'Solved\Forms'       => $config->application->formsDir,
    'Solved\Helpers'     => $config->application->helpersDir,
    'Solved'             => $config->application->libraryDir
]);

$loader->register();

// Use composer autoloader to load vendor classes
require_once BASE_PATH . '/vendor/autoload.php';
