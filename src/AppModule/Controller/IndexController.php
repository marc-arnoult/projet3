<?php

namespace AppModule\Controller;

use AppModule\Model\ArticleDAO;
use AppModule\Model\CommentDAO;
use Core\Controller\Controller;
use Core\Database\Database;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class IndexController extends Controller
{

    public function indexAction(Request $request)
    {
        $session = new Session();
        $session->start();

        $commentDAO = new CommentDAO();
        $articleDAO = new ArticleDAO();
        $articles = $articleDAO->getAll(3);

        $request->attributes->set('articles', array_reverse($articles));
        $request->attributes->set('commentDAO', $commentDAO);
        $request->setSession($session);

        $messages = $session->getFlashBag()->all() ?? null;

        $request->attributes->set('messages', $messages);

        return $this->render($request);
    }
}