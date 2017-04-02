<?php

use AppModule\Controller\{
    ArticleController, AuthController, CommentController, IndexController, AdminController, UserController
};
use Symfony\Component\Routing\{RouteCollection, Route};

$routes = new RouteCollection();

$routes->add('home', new Route('/', array(
    '_controller' => array(new IndexController(), 'indexAction')
), array(), array(), '', array(), array('GET')));


$routes->add('articles_list', new Route('/articles', array(
    '_controller' => array(new ArticleController(), 'indexAction')
), array(), array(), '', array(), array('GET')));

$routes->add('article', new Route('/article/{id}', array(
    'id' => 'id',
    '_controller' => array(new ArticleController(), 'showAction')
), array(), array(), '', array(), array('GET')));

$routes->add('#send-email#', new Route('/send-email', array(
    '_controller' => array(new IndexController(), 'sendMailAction')
), array(), array(), '', array(), array('POST')));


/********************
 *      @ADMIN      *
 ********************/

$routes->add('admin/index', new Route('/admin', array(
    '_controller' => array(new AdminController(), 'indexAction')
), array(), array(), '', array(), array('GET')));

/***************************
 *      @ADMIN-ARTICLES    *
 ***************************/

$routes->add('admin/articles', new Route('/admin/articles', array(
    '_controller' => array(new ArticleController(),'showArticleAction')
), array(), array(), '', array(), array('GET')));

$routes->add('admin/article', new Route('/admin/article', array(
    '_controller' => array(new ArticleController(), 'addShowAction')
), array(), array(), '', array(), array('GET')));

$routes->add('#admin/article/post#', new Route('/admin/articles', array(
    '_controller' => array(new ArticleController(), 'postAction')
), array(), array(), '', array(), array('POST')));

$routes->add('#admin/article/delete#', new Route('/admin/articles', array(
    '_controller' => array(new ArticleController(), 'deleteAction')
), array(), array(), '', array(), array('DELETE')));

$routes->add('admin/article.edition', new Route('/admin/edition/article/{id}', array(
    'id' => 'id',
    '_controller' => array(new ArticleController() ,'editShowAction')
), array('id' => '\d+'), array(), '', array(), array('GET')));

$routes->add('#admin/article.edition#', new Route('/admin/edition/article', array(
    '_controller' => array(new ArticleController(), 'editAction')
), array(), array(), '', array(), array('PUT')));

/***************************
 *      @ADMIN-COMMENT     *
 ***************************/

$routes->add('admin/comments', new Route('/admin/comments', array(
    '_controller' => array(new CommentController(), 'indexAction')
), array(), array(), '', array(), array('GET')));

/***************************
 *       @ADMIN-USERS      *
 ***************************/

$routes->add('admin/users', new Route('/admin/users', array(
    '_controller' => array(new UserController(), 'showAction')
), array(), array(), '', array(), array('GET')));

$routes->add('#admin/user/delete#', new Route('/admin/user', array(
    '_controller' => array(new UserController(), 'deleteAction')
), array(), array(), '', array(), array('DELETE')));

/********************
 *     @SIGN-OUT    *
 ********************/

$routes->add('sign_out', new Route('/deconnexion', array(
    '_controller' => array(new AuthController(), 'signOutAction')
), array(), array(), '', array(), array('GET')));

/********************
 *     @SIGN-UP     *
 ********************/

$routes->add('sign_up', new Route('/inscription', array(
    '_controller' => array(new AuthController(), 'signUpShowAction')
), array(), array(), '', array(), array('GET')));

$routes->add('#sign_up#', new Route('/inscription', array(
    '_controller' => array(new AuthController(), 'signUpAction')
), array(), array(), '', array(), array('POST')));

/********************
 *     @SIGN-IN     *
 ********************/

$routes->add('sign_in', new Route('/connexion', array(
    '_controller' => array(new AuthController(), 'signInShowAction')
), array(), array(), '', array(), array('GET')));

$routes->add('#sign_in#', new Route('/connexion', array(
    '_controller' => array(new AuthController(), 'signInAction')
), array(), array(), '', array(), array('POST')));

/********************
 *      @COMMENT    *
 ********************/

$routes->add('comments', new Route('/comments', array(
    '_controller' => array(new CommentController(), 'postAction')
), array(), array(), '', array(), array('POST')));

$routes->add('#response#', new Route('/comment-response', array(
    '_controller' => array(new CommentController(), 'responseAction')
), array(), array(), '', array(), array('POST')));

$routes->add('#delete#', new Route('/comment', array(
    '_controller' => array(new CommentController(), 'deleteAction')
), array(), array(), '', array(), array('DELETE')));

$routes->add('#edit#', new Route('/comment', array(
    '_controller' => array(new CommentController(), 'editAction')
), array(), array(), '', array(), array('PUT')));

$routes->add('#reporting#', new Route('/reporting-comment', array(
    '_controller' => array(new CommentController(), 'reportAction')
), array(), array(), '', array(), array('POST')));

return $routes;