<?php
namespace AppModule\Controller;

use AppModule\Model\Article;
use AppModule\Model\ArticleDAO;
use AppModule\Model\CommentDAO;
use AppModule\Model\UserDAO;
use Core\Controller\Controller;
use Predis\Client;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class ArticleController extends Controller
{
    /**
     * Return the page /articles
     *
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $session = new Session();

        $articleDAO = new ArticleDAO(self::$db, self::$cache);
        $commentDAO = new CommentDAO(self::$db, self::$cache);

        $articles = $articleDAO->getAllPublished();
        $articlesByDates = $articleDAO->getAllByDate();

        $request->setSession($session);
        $request->attributes->set('articles', $articles);
        $request->attributes->set('commentDAO', $commentDAO);
        $request->attributes->set('articlesByDates', $articlesByDates);

        return $this->render($request);
    }

    /**
     * Return view associate with the $id (/article/$id)
     *
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function showAction(Request $request, $id)
    {
        $session = new Session();

        $commentDAO = new CommentDAO(self::$db, self::$cache);
        $articleDAO = new ArticleDAO(self::$db, self::$cache);

        $article = $articleDAO->getPublished($id);
        $comments = $commentDAO->getAllWithChildren($id);
        $messages = $session->getFlashBag()->all() ?? null;

        if(!$article) {
            $session
                ->getFlashBag()
                ->add('error', 'L\'article n\'existe pas');
            header('Location: /');
            exit();
        }

        $request->setSession($session);
        $request->attributes->set('messages', $messages);
        $request->attributes->set('article', $article);
        $request->attributes->set('comments', $comments);

        return $this->render($request);
    }

    /**
     * Return view for adding an article
     *
     * @param Request $request
     * @return Response
     */

    public function addShowAction(Request $request)
    {
        $session = new Session();
        $this->userRoleIs($session, 'administrateur');

        $userDAO = new UserDAO();
        $articleDAO = new ArticleDAO(self::$db, self::$cache);

        $messages = $session->getFlashBag()->all() ?? null;
        $nbUser = $userDAO->getCountUser()->nbUser;
        $nbArticle = $articleDAO->getCountArticles()->nbArticle;

        $request->attributes->set('nbArticle', $nbArticle);
        $request->attributes->set('nbUser', $nbUser);
        $request->attributes->set('messages', $messages);

        $request->setSession($session);
        return $this->render($request);
    }

    /**
     *
     *
     * @param Request $request
     * @return Response
     */

    public function showArticleAction(Request $request) {
        $session = new Session();
        $this->userRoleIs($session, 'administrateur');

        $articleDAO = new ArticleDAO(self::$db, self::$cache);
        $articles = $articleDAO->getAll();

        $nbArticles = $articleDAO->getCountArticles();
        $messages = $session->getFlashBag()->all() ?? null;

        $request->attributes->set('messages', $messages);
        $request->attributes->set('nbArticles', $nbArticles);
        $request->attributes->set('articles', $articles);

        return $this->render($request);
    }

    /**
     * @param Request $request
     */
    public function postAction(Request $request)
    {
        $session = new Session();
        $user = $session->get('user');

        $this->userRoleIs($session, 'administrateur');

        $data = array();
        $data['title'] = $request->request->get('title');
        $data['content'] = $request->request->get('content');
        $data['published'] = $request->request->get('published');
        $data['idUser'] = $user->getId();

        $article = new Article($data);
        $articleDAO = new ArticleDAO(self::$db, self::$cache);

        $result = $articleDAO->add($article);

        if($result) {
            if($article->getPublished()) {
                $session
                    ->getFlashBag()
                    ->add('success', 'Article publié');
                header("Location: /admin/articles");
                exit();
            }

            $session
                ->getFlashBag()
                ->add('success', 'Article enregistré');
            header("Location: /admin/articles");
            exit();
        }

        $session
            ->getFlashBag()
            ->add('error', 'Erreur lors de l\'enregistrement de l\'article');
        header("Location: /admin/articles");
        exit();
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function deleteAction (Request $request)
    {
        $session = new Session();

        $this->userRoleIs($session, 'administrateur');

        $id = $request->request->get('id');

        $articleDAO = new ArticleDAO(self::$db, self::$cache);
        $result = $articleDAO->delete($id);

        if ($result) {
            $session
                ->getFlashBag()
                ->add('success', 'Article supprimé');

            return new Response('Article supprimé');
        }

        $session
            ->getFlashBag()
            ->add('error', 'Erreur lors de la suppresion de l\'article');

        return new Response('Erreur lors de la suppresion de l\'article');

    }

    /**
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function editShowAction (Request $request, $id)
    {
        $session = new Session();

        $this->userRoleIs($session, 'administrateur');

        $articleDAO = new ArticleDAO(self::$db, self::$cache);
        $article = $articleDAO->get($id);
        $messages = $session->getFlashBag()->all() ?? null;

        if($article == false) {
            header('Location: /admin/articles');
            exit();
        }

        $request->attributes->set('messages', $messages);
        $request->attributes->set('article', $article);

        return $this->render($request);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function editAction (Request $request)
    {
        $session = new Session();
        $user = $session->get('user');

        $this->userRoleIs($session, 'administrateur');

        $data = $request->request->all();
        $data['idUser'] = $user->getId();

        $article = new Article($data);
        $articleDAO = new ArticleDAO(self::$db, self::$cache);

        $result = $articleDAO->update($article);

        if($result) {
            $session
                ->getFlashBag()
                ->add('success', 'Article modifié');
            return new Response('Article modifié');
        }

        $session
            ->getFlashBag()
            ->add('error', 'Erreur lors de la modification de l\'article');
        return new Response('Erreur lors de la modification de l\'article');
    }
}