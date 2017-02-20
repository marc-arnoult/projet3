<?php

namespace AppModule\Controller;

use AppModule\Model\ArticleDAO;
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
        $articleDAO = new ArticleDAO();
        $articles = $articleDAO->getAll();
        $request->attributes->set('articles', $articles);
        $request->setSession($session);
        var_dump($session->all());
        return $this->render($request);
    }
}