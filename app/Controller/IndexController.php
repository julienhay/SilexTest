<?php

namespace App\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
        $index->match("", 'App\Controller\IndexController::index')->bind("index.index");
        $index->match("/adddata", 'App\Controller\IndexController::adddata')->bind("index.add_data");

        return $index;
    }


}


