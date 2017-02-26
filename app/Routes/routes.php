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

$routes->add('/admin/index', new Route('/admin', array(
    '_controller' => 'AppModule\\Controller\\AdminController::indexAction'
)));

$routes->add('sign_out', new Route('/deconnexion', array(
    '_controller' => 'AppModule\\Controller\\AuthController::signOutAction'
), array(), array(), '', array(), array('GET')));

/********************
 *     SIGN UP      *
 ********************/

$routes->add('sign_up', new Route('/inscription', array(
    '_controller' => 'AppModule\\Controller\\AuthController::signUpShowAction'
), array(), array(), '', array(), array('GET')));

$routes->add('#sign_up#', new Route('/inscription', array(
    '_controller' => 'AppModule\\Controller\\AuthController::signUpAction'
), array(), array(), '', array(), array('POST')));

/********************
 *     SIGN IN      *
 ********************/

$routes->add('sign_in', new Route('/connexion', array(
    '_controller' => 'AppModule\\Controller\\AuthController::signInShowAction'
), array(), array(), '', array(), array('GET')));

$routes->add('#sign_in#', new Route('/connexion', array(
    '_controller' => 'AppModule\\Controller\\AuthController::signInAction'
), array(), array(), '', array(), array('POST')));

/********************
 *      COMMENT     *
 ********************/

$routes->add('#comments#', new Route('/comments', array(
    '_controller' => 'AppModule\\Controller\\CommentController::addAction'
), array(), array(), '', array(), array('POST')));

return $routes;