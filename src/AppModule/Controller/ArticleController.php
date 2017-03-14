<?php
namespace AppModule\Controller;

use AppModule\Model\Article;
use AppModule\Model\ArticleDAO;
use AppModule\Model\CommentDAO;
use AppModule\Model\UserDAO;
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
        $messages = $session->getFlashBag()->all() ?? null;


        if(!$article) {
            header('Location: http://localhost:8000');
            exit();
        }

        $request->setSession($session);
        $request->attributes->set('messages', $messages);
        $request->attributes->set('article', $article);
        $request->attributes->set('comments', $comments);

        return $this->render($request);
    }
    public function addAction(Request $request)
    {
        $session = new Session();
        $userDAO = new UserDAO();
        $articleDAO = new ArticleDAO();

        $messages = $session->getFlashBag()->all() ?? null;
        $nbUser = $userDAO->getCountUser()->nbUser;
        $nbArticle = $articleDAO->getCountArticles()->nbArticle;

        $request->attributes->set('nbArticle', $nbArticle);
        $request->attributes->set('nbUser', $nbUser);
        $request->attributes->set('messages', $messages);

        $request->setSession($session);
        return $this->render($request);
    }

    public function showArticleAction(Request $request) {
        $articleDAO = new ArticleDAO();
        $session = new Session();

        $articles = $articleDAO->getAll();
        $nbArticles = $articleDAO->getCountArticles();
        $messages = $session->getFlashBag()->all() ?? null;

        $request->attributes->set('messages', $messages);
        $request->attributes->set('nbArticles', $nbArticles);
        $request->attributes->set('articles', $articles);

        return $this->render($request);
    }

    public function postAction(Request $request)
    {
        $session = new Session();
        $user = $session->get('user');

        if($user->getRole() === 'administrateur') {
            $data = array();
            $data['title'] = $request->request->get('title');
            $data['content'] = $request->request->get('content');
            $data['idUser'] = $user->getId();

            $article = new Article($data);
            $articleDAO = new ArticleDAO();

            $result = $articleDAO->add($article);

            if($result) {
                $session
                    ->getFlashBag()
                    ->add('success', 'Article bien enregistré');
                $http_referer = $request->server->get('HTTP_REFERER');
                header("Location: {$http_referer}");
            } else {
                $session
                    ->getFlashBag()
                    ->add('error', 'Erreur lors de l\'enregistrement de l\'article');
                $http_referer = $request->server->get('HTTP_REFERER');
                header("Location: {$http_referer}");
            }
        } else {
            return new Response('Vous n\'êtes pas habilité pour faire ça');
        }
    }

    public function deleteAction (Request $request)
    {
        $session = new Session();
        $user = $session->get('user');

        if($user->getRole() === 'administrateur') {
            $id = $request->request->get('id');

            $articleDAO = new ArticleDAO();
            $result = $articleDAO->delete($id);

            if($result) {
                $session
                    ->getFlashBag()
                    ->add('success', 'article supprimé');
            } else {
                $session
                    ->getFlashBag()
                    ->add('error', 'Erreur lors de la suppresion de l\'article');
            }

        }
    }

    public function editAction (Request $request)
    {

    }
}