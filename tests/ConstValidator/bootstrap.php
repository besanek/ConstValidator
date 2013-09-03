<?php

$dirs = array();

$autoload = __DIR__ . '/../../vendor/autoload.php';
require_once $autoload;

if (!class_exists('Tester\Assert')) {
    echo "Install Nette Tester using `composer update --dev`\n";
    exit(1);
}

if (extension_loaded('xdebug')) {
    xdebug_disable();
    Tester\CodeCoverage\Collector::start(__DIR__ . '/coverage.dat');
}

include_once(__DIR__ . '/helpers/TestClass.php');

Tester\Helpers::setup();

function self($val)
{
    return $val;
}
