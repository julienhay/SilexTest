<?php

$loader = require __DIR__ . '/../vendor/autoload.php';
$loader->add("App",dirname(__DIR__));

$config_bundle = require __DIR__ . '/../App/Config/ConfigBundle.php';

$app = new App\SilexTestApplication(
	[ 
		'debug' => true,
		'config_bundle' => $config_bundle
	]
);

$app->run();
