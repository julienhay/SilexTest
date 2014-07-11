<?php

$config['twig'] = 
[
    "twig.path" => dirname(__DIR__) . "/Views",
    'twig.options' => 
    [
    	'cache' => dirname(__DIR__).'/tmp/cache', 
    	'strict_variables' => true
    ]
];

$config['webprofiler'] = [
    'profiler.cache_dir' => dirname(__DIR__).'/tmp/cache/profiler', 
    'profiler.mount_prefix' => '/_profiler',
];


return $config;