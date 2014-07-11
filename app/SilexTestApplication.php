<?php 

namespace App;

use Silex;
use Silex\Provider;
use Silex\Route;

use Doctrine\Common\ClassLoader;
use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\MongoDB\Connection;
use Silex\Application as SilexApplication;


/**
* SilexTest
*/
class SilexTestApplication extends SilexApplication
{
	
	public function __construct(array $values = array())
	{
		parent::__construct($values);

		$this['debug'] = $values['debug'];


		$this->getBundles($values['config_bundle']);
		$this->getServices();
		$this->getRoutes();
	}

	/**
	 * Config Bundles
	 */
	private function getBundles(array $config) 
	{
		$this->register(new Silex\Provider\TwigServiceProvider(), $config['twig']);
		$this->register(new Silex\Provider\ServiceControllerServiceProvider());

		if($this['debug'])
		{
			$this->register(new Provider\WebProfilerServiceProvider(), $config['webprofiler']);
			$this->register(new Silex\Provider\UrlGeneratorServiceProvider());
		}
	}

	/**
	 * Create Routes
	 */
	private function getRoutes() 
	{
		$this->mount("/", new Controllers\IndexController());
	}

	/**
	 * Assign Service
	 */
	private function getServices()
	{
		$this['mongo_db'] = $this->share(function () {
		    return new Services\MongoService();
		});
	}
}