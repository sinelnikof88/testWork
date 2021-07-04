#!/usr/bin/env php
<?php
require __DIR__ . '/vendor/autoload.php';


//use Symfony\Component\Console\Application;
$config = require __DIR__ . '/config.php';
$application = \application\App::getInstance();
$application->config = $config;
# add our commands
$application->add(new Commands\CounterCommand());

$application->run();
