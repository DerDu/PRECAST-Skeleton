<?php

// #####################################################################################################################

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR
    . 'Vendor' . DIRECTORY_SEPARATOR
    . 'Repository' . DIRECTORY_SEPARATOR
    . 'autoload.php';

// #####################################################################################################################

$Whoops = new \Whoops\Run;
$Whoops->pushHandler(new \Whoops\Handler\PlainTextHandler());
$Whoops->register();

// #####################################################################################################################

\PRECAST\Environment\Environment::setEnvironment(
    \PRECAST\Environment\Environment::USE_TEST
);

// #####################################################################################################################

