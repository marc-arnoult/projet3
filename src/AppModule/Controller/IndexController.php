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

        $success = $session->getFlashBag()->get('success')['success'] ?? null;
        $error = $session->getFlashBag()->get('error')['error'] ?? null;

        $request->attributes->set('success', $success);
        $request->attributes->set('error', $error);

        return $this->render($request);
    }
}