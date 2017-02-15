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
        $db = new Database();
        $articles = $db->query('SELECT * FROM articles LIMIT 0, 5')->fetch(\PDO::FETCH_OBJ);
        $request->attributes->set('articles', $articles);
        $request->setSession($session);
        return $this->render($request);
    }
}