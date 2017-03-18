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
), array(), array(), '', array(), array('GET')));

/********************
 *      ADMIN       *
 ********************/

$routes->add('admin/index', new Route('/admin', array(
    '_controller' => 'AppModule\\Controller\\AdminController::indexAction'
), array(), array(), '', array(), array('GET')));

$routes->add('admin/articles', new Route('/admin/articles', array(
    '_controller' => 'AppModule\\Controller\\ArticleController::showArticleAction'
), array(), array(), '', array(), array('GET')));

$routes->add('admin/article', new Route('/admin/article', array(
    '_controller' => 'AppModule\\Controller\\ArticleController::addShowAction'
), array(), array(), '', array(), array('GET')));

$routes->add('#admin/article/post#', new Route('/admin/articles', array(
    '_controller' => 'AppModule\\Controller\\ArticleController::postAction'
), array(), array(), '', array(), array('POST')));

$routes->add('#admin/article/delete#', new Route('/admin/articles', array(
    '_controller' => 'AppModule\\Controller\\ArticleController::deleteAction'
), array(), array(), '', array(), array('DELETE')));

$routes->add('admin/article.edition', new Route('/admin/edition/article/{id}', array(
    'id' => 'id',
    '_controller' => 'AppModule\\Controller\\ArticleController::editShowAction'
), array(), array(), '', array(), array('GET')));

$routes->add('#admin/article.edition#', new Route('/admin/edition/article', array(
    '_controller' => 'AppModule\\Controller\\ArticleController::editAction'
), array(), array(), '', array(), array('PUT')));

$routes->add('admin/comments', new Route('/admin/comments', array(
    '_controller' => 'AppModule\\Controller\\CommentController::indexAction'
), array(), array(), '', array(), array('GET')));

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

$routes->add('comments', new Route('/comments', array(
    '_controller' => 'AppModule\\Controller\\CommentController::postAction'
), array(), array(), '', array(), array('POST')));

$routes->add('#response#', new Route('/comment-response', array(
    '_controller' => 'AppModule\\Controller\\CommentController::responseAction'
), array(), array(), '', array(), array('POST')));

$routes->add('#delete#', new Route('/comment', array(
    '_controller' => 'AppModule\\Controller\\CommentController::deleteAction'
), array(), array(), '', array(), array('DELETE')));

$routes->add('#edit#', new Route('/comment', array(
    '_controller' => 'AppModule\\Controller\\CommentController::editAction'
), array(), array(), '', array(), array('PUT')));

return $routes;