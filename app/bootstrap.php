<?php

use Silex\Provider,
	Doctrine\Common\ClassLoader,
    Doctrine\ODM\MongoDB\Configuration,
    Doctrine\Common\Annotations\AnnotationReader,
    Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver,
    Doctrine\ODM\MongoDB\DocumentManager,
    Doctrine\MongoDB\Connection,
    App\Services\MongoService;


/**
 * Start
 */
ini_set('date.timezone', 'Europe/Paris');
require_once(__DIR__.'/Config/config.php');

$loader = require_once __DIR__ . '/../vendor/autoload.php';

$loader->add("App",dirname(__DIR__));

$app = new Silex\Application();

$app['debug'] = DEBUG;


/**
 * TWIG
 */
$app->register(
	new Silex\Provider\TwigServiceProvider(), [
	    "twig.path" => dirname(__DIR__) . "/app/Views",
	    'twig.options' => 
	    [
	    	'cache' => dirname(__DIR__).'/app/tmp/cache', 
	    	'strict_variables' => true
	    ]
	]
);

/**
 * ServiceControllerServiceProvider
 */
$app->register(new Silex\Provider\ServiceControllerServiceProvider());


/**
 * WebProfilerServiceProvider
 */
if($app['debug'])
{
	$app->register(new Provider\WebProfilerServiceProvider(), array(
	    'profiler.cache_dir' => dirname(__DIR__).'/app/tmp/cache/profiler', 
	    'profiler.mount_prefix' => '/_profiler', // this is the default
	));

	$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
}


/**
 * Services
 */
$app['mongo_db'] = $app->share(function () {
    return new MongoService();
});


/**
 * Routes
 */
$app->mount("/", new App\Controller\IndexController());
//$app->mount("/unessai/", new App\Controller\TestController());


$app->run();
