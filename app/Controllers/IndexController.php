<?php

namespace App\Controllers;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

use App\Documents\Measurement;

class IndexController implements ControllerProviderInterface
{
    public function index(Application $app)
    {
        return $app["twig"]->render("index/index.twig");
    }

    public function adddata(Application $app)
    {        
        $mongo = $app['mongo_db'];
        // Insert Data
        $captors = [
            'captor1' => 25,
            'captor2' => 1200
        ];

        $measurement = new Measurement($captors);
        $mongo->dm->persist($measurement);
        $mongo->dm->flush();

        return new RedirectResponse($app['url_generator']->generate('index.index'));
    }

    public function connect(Application $app)
    {
        // créer un nouveau controller basé sur la route par défaut
        $index = $app['controllers_factory'];
        $index->match("", 'App\Controllers\IndexController::index')->bind("index.index");
        $index->match("/adddata", 'App\Controllers\IndexController::adddata')->bind("index.add_data");

        return $index;
    }


}


