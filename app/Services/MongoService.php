<?php

namespace App\Services;

use Doctrine\Common\ClassLoader,
    Doctrine\ODM\MongoDB\Configuration,
    Doctrine\Common\Annotations\AnnotationReader,
    Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver,
    Doctrine\ODM\MongoDB\DocumentManager,
    Doctrine\MongoDB\Connection;


/**
* MongoService
*/
class MongoService
{
	public $dm;

    public function __construct()
    {
        /**
        * MONGO DB
        */
        $config = new Configuration();
        $config->setProxyDir(__DIR__ . '/tmp/cache');
        $config->setProxyNamespace('Proxies');

        $config->setHydratorDir(__DIR__ . '/tmp/cache');
        $config->setHydratorNamespace('Hydrators');

        $annotationDriver = $config->newDefaultAnnotationDriver(
            array(__DIR__ . '/Documents')
        );
        $config->setMetadataDriverImpl($annotationDriver);
        AnnotationDriver::registerAnnotationClasses();

        $this->dm = DocumentManager::create(new Connection(), $config);

        $classLoader = new ClassLoader('Documents', __DIR__);
        $classLoader->register();
    }
}