<?php
namespace AppModule\Controller;

use AppModule\Model\ArticleDAO;
use AppModule\Model\CommentDAO;
use Core\Controller\Controller;
use Core\Database\Database;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class ArticleController extends Controller
{
    public function indexAction(Request $request)
    {
        $session = new Session();

        $articleDAO = new ArticleDAO();
        $commentDAO = new CommentDAO();

        $articles = $articleDAO->getAll();

        $request->setSession($session);
        $request->attributes->set('articles', $articles);
        $request->attributes->set('commentDAO', $commentDAO);

        return $this->render($request);
    }

    public function showAction(Request $request, $id)
    {
        $session = new Session();
        $commentDAO = new CommentDAO();
        $articleDAO = new ArticleDAO();

        $articles = $articleDAO->get($id);
        $comments = $commentDAO->getAll($id);

        if(!$articles) {
            header('Location: http://localhost:8000');
            exit();
        }
        $request->setSession($session);
        $request->attributes->set('articles', $articles);
        $request->attributes->set('comments', $comments);

        return $this->render($request);
    }

    public function postAction(Request $request)
    {
        var_dump($request->request->all());
    }
}