<?php

use Symfony\Component\Routing\{RouteCollection, Route};

$routes = new RouteCollection();

$routes->add('home', new Route('/', array(
    '_controller' => 'AppModule\\Controller\\IndexController::indexAction'
), array(), array(), '', array(), array('GET')));

$routes->add('articles_list', new Route('/articles', array(
    '_controller' => 'AppModule\\Controller\\ArticleController::indexAction'
)));

$routes->add('article', new Route('/article/{id}', array(
    '_controller' => 'AppModule\\Controller\\ArticleController::showAction'
)));

$routes->add('/admin/home', new Route('/admin', array(
    '_controller' => 'AppModule\\Controller\\AdminController::indexAction'
)));

return $routes;