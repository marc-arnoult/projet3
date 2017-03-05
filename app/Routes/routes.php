<?php

use Symfony\Component\Routing\{RouteCollection, Route};

$routes = new RouteCollection();

$routes->add('home', new Route('/', array(
    '_controller' => 'AppModule\\Controller\\IndexController::indexAction'
), array(), array(), '', array(), array('GET')));


$routes->add('articles_list', new Route('/articles', array(
    '_controller' => 'AppModule\\Controller\\ArticleController::indexAction'
), array(), array(), '', array(), array('GET')));

$routes->add('article', new Route('/article/{id}', array(
    'id' => 'id',
    '_controller' => 'AppModule\\Controller\\ArticleController::showAction'
)));

/********************
 *      ADMIN       *
 ********************/

$routes->add('/admin/index', new Route('/admin', array(
    '_controller' => 'AppModule\\Controller\\AdminController::indexAction'
)));

$routes->add('/admin/articles', new Route('/admin/articles', array(
    '_controller' => 'AppModule\\Controller\\AdminController::articleAction'
), array(), array(), '', array(), array('GET')));

$routes->add('#/admin/articles#', new Route('/admin/articles', array(
    '_controller' => 'AppModule\\Controller\\AdminController::articlePostAction'
), array(), array(), '', array(), array('POST')));

/********************
 *     SIGN OUT      *
 ********************/

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
    '_controller' => 'AppModule\\Controller\\CommentController::postAction'
), array(), array(), '', array(), array('POST')));

$routes->add('#response#', new Route('/response-comment', array(
    '_controller' => 'AppModule\\Controller\\CommentController::responseAction'
), array(), array(), '', array(), array()));

return $routes;