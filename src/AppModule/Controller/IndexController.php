<?php

namespace AppModule\Controller;

use AppModule\Mailer\Mailer;
use AppModule\Model\ArticleDAO;
use AppModule\Model\CommentDAO;
use Core\Controller\Controller;

use Core\Database\Database;
use Core\Database\RedisCache;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class IndexController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $session = new Session();

        $commentDAO = new CommentDAO(self::$db, self::$cache);
        $articleDAO = new ArticleDAO(self::$db, self::$cache);

        $articles = $articleDAO->getAllPublished(1);
        $lastComments = $commentDAO->getLast(3);

        $messages = $session->getFlashBag()->all() ?? null;

        $request->attributes->set('lastComments', $lastComments);
        $request->attributes->set('articles', array_reverse($articles));
        $request->attributes->set('commentDAO', $commentDAO);
        $request->attributes->set('messages', $messages);
        $request->setSession($session);

        return $this->render($request);
    }

    public function sendMailAction(Request $request)
    {
        $data = $request->request->all();
        mail('marc.arnoult@hotmail.fr', $data['subject'], $data['message']);
        return new Response('Email envoyé');
    }

}