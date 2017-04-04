<?php
/**
 * Created by PhpStorm.
 * User: marc
 * Date: 11/02/2017
 * Time: 12:40
 */

namespace AppModule\Controller;


use AppModule\Model\ArticleDAO;
use AppModule\Model\CommentDAO;
use AppModule\Model\UserDAO;
use Core\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Session\Session;

class AdminController extends Controller
{

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $session = new Session();
        $this->userRoleIs($session, 'administrateur');

        $messages = $session->getFlashBag()->all() ?? null;
        $request->attributes->set('messages', $messages);


        $userDAO = new UserDAO(self::$db, self::$cache);
        $articleDAO = new ArticleDAO(self::$db, self::$cache);
        $commentDAO = new CommentDAO(self::$db, self::$cache);

        $nbUser = $userDAO->getCountUser()->nbUser;
        $nbArticle = $articleDAO->getCountArticles()->nbArticle;
        $nbComment = $commentDAO->getCountComment()->nbComments;

        $request->attributes->set('nbArticle', $nbArticle);
        $request->attributes->set('nbUser', $nbUser);
        $request->attributes->set('nbComment', $nbComment);

        return $this->render($request);

    }

}