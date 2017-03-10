<?php
namespace AppModule\Controller;

use AppModule\Model\ArticleDAO;
use AppModule\Model\CommentDAO;
use Core\Controller\Controller;
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

        $article = $articleDAO->get($id);
        $comments = $commentDAO->getAllWithChildren($id);

        if(!$article) {
            header('Location: http://localhost:8000');
            exit();
        }

        $request->setSession($session);
        $request->attributes->set('article', $article);
        $request->attributes->set('comments', $comments);

        return $this->render($request);
    }
}