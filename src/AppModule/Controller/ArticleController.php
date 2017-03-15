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
            header('Location: /admin/articles');
            exit();
        }

        $request->setSession($session);
        $request->attributes->set('messages', $messages);
        $request->attributes->set('article', $article);
        $request->attributes->set('comments', $comments);

        return $this->render($request);
    }
    public function addShowAction(Request $request)
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

        if($this->userRoleIs($user, 'administrateur')) {
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
                header("Location: /admin/articles");
            } else {
                $session
                    ->getFlashBag()
                    ->add('error', 'Erreur lors de l\'enregistrement de l\'article');
                header("Location: /admin/articles");
            }
        } else {
            return new Response('Vous n\'êtes pas habilité pour faire ça');
        }
    }

    public function deleteAction (Request $request)
    {
        $session = new Session();
        $user = $session->get('user');

        if($this->userRoleIs($user, 'administrateur')) {
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

    public function editShowAction (Request $request, $id)
    {
        $session = new Session();

        $articleDAO = new ArticleDAO();
        $article = $articleDAO->get($id);
        $messages = $session->getFlashBag()->all() ?? null;

        if($article == false) {
            header('Location: /admin/articles');
            return false;
        }

        $request->attributes->set('messages', $messages);
        $request->attributes->set('article', $article);

        return $this->render($request);
    }

    public function editAction (Request $request)
    {
        $session = new Session();
        $user = $session->get('user');

        $data = $request->request->all();
        $data['idUser'] = $user->getId();

        $article = new Article($data);
        $articleDAO = new ArticleDAO();

        $result = $articleDAO->update($article);

        if($result) {
            $session
                ->getFlashBag()
                ->add('success', 'article modifié');
        } else {
            $session
                ->getFlashBag()
                ->add('error', 'Erreur lors de la modification de l\'article');
        }

        return new JsonResponse($result);
    }
}