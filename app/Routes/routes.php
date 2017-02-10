<?php

use Symfony\Component\Routing\{RouteCollection, Route};

$routes = new RouteCollection();

$routes->add('home', new Route('/', array(
    '_controller' => 'AppModule\\Controller\\IndexController::indexAction'
), array(), array(), '', array(), array('GET')));

$routes->add('articles', new Route('/articles', array(
    '_controller' => 'AppModule\\Controller\\ArticleController::testAction'
)));

$routes->add('articles_list', new Route('/articles/{id}/{name}', array(
    '_controller' => 'AppModule\\Controller\\ArticleController::showAction'
)));

return $routes;