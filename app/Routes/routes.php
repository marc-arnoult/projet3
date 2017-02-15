<?php

use Symfony\Component\Routing\{RouteCollection, Route};

$routes = new RouteCollection();

$routes->add('home', new Route('/', array(
    '_controller' => 'AppModule\\Controller\\IndexController::indexAction'
), array(), array(), '', array(), array('GET')));

$routes->add('articles_list', new Route('/articles', array(
    '_controller' => 'AppModule\\Controller\\ArticleController::indexAction'
), array(), array(), '', array(), array('GET')));

$routes->add('', new Route('/articles', array(
    '_controller' => 'AppModule\\Controller\\ArticleController::postAction'
), array(), array(), '', array(), array('POST')));

$routes->add('article', new Route('/article/{id}', array(
    'id' => 'id',
    '_controller' => 'AppModule\\Controller\\ArticleController::showAction'
)));

$routes->add('/admin/home', new Route('/admin', array(
    '_controller' => 'AppModule\\Controller\\AdminController::indexAction'
)));

$routes->add('sign_up', new Route('/inscription', array(
    '_controller' => 'AppModule\\Controller\\ConnectController::indexAction'
), array(), array(), '', array(), array('GET')));

$routes->add('', new Route('/inscription', array(
    '_controller' => 'AppModule\\Controller\\ConnectController::signUpAction'
), array(), array(), '', array(), array('POST')));

return $routes;