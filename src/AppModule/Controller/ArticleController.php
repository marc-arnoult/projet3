<?php
namespace AppModule\Controller;

use AppModule\Model\Article;
use AppModule\Model\ArticleDAO;
use AppModule\Model\CommentDAO;
use AppModule\Model\UserDAO;
use Core\Controller\Controller;
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
    public function indexAction(Request $request) : Response
    {
        $session = $this->getSession();

        $articleDAO = new ArticleDAO(self::$db, self::$cache);
        $commentDAO = new CommentDAO(self::$db, self::$cache);

        $articles = $articleDAO->getAllPublished();
        $articlesByDates = $articleDAO->getAllByDate();

        $request->attributes->set('articles', $articles);
        $request->attributes->set('commentDAO', $commentDAO);
        $request->attributes->set('articlesByDates', $articlesByDates);
        $request->setSession($session);

        return $this->render($request);
    }

    /**
     * Return view associate with the $id (/article/$id)
     *
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function showAction(Request $request, int $id) : Response
    {
        $session = $this->getSession();

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

            return null;
        }

        $request->attributes->set('messages', $messages);
        $request->attributes->set('article', $article);
        $request->attributes->set('comments', $comments);
        $request->setSession($session);

        return $this->render($request);
    }

    /**
     * Return view for adding an article
     *
     * @param Request $request
     * @return Response
     */

    public function addShowAction(Request $request) : Response
    {
        $session = $this->getSession();
        $this->userRoleIs($session, 'administrateur');

        $userDAO = new UserDAO(self::$db, self::$cache);
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

    public function showArticleAction(Request $request) : Response
    {
        $session = $this->getSession();
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
     * @return null
     */
    public function postAction(Request $request)
    {
        $session = $this->getSession();
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

                return null;
            }

            $session
                ->getFlashBag()
                ->add('success', 'Article enregistré');
            header("Location: /admin/articles");

            return null;
        }

        $session
            ->getFlashBag()
            ->add('error', 'Erreur lors de l\'enregistrement de l\'article');
        header("Location: /admin/articles");

        return null;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function deleteAction (Request $request) : Response
    {
        $session = $this->getSession();
        $response = new Response();

        $this->userRoleIs($session, 'administrateur');

        $id = $request->request->get('id');

        $articleDAO = new ArticleDAO(self::$db, self::$cache);
        $result = $articleDAO->delete($id);

        if ($result) {
            $session->getFlashBag()->add('success', 'Article supprimé');

            $response->setStatusCode(Response::HTTP_OK);
            return $response;
        }

        $session->getFlashBag()->add('error', 'Erreur lors de la suppresion de l\'article');

        $response->setStatusCode(Response::HTTP_BAD_REQUEST);
        return $response;
    }

    /**
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function editShowAction (Request $request, int $id) : Response
    {
        $session = $this->getSession();

        $this->userRoleIs($session, 'administrateur');

        $articleDAO = new ArticleDAO(self::$db, self::$cache);
        $article = $articleDAO->get($id);
        $messages = $session->getFlashBag()->all() ?? null;

        if(!$article) {
            header('Location: /admin/articles');

            return null;
        }

        $request->attributes->set('messages', $messages);
        $request->attributes->set('article', $article);

        return $this->render($request);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function editAction (Request $request) : Response
    {
        $session = $this->getSession();
        $user = $session->get('user');
        $response = new Response();

        $this->userRoleIs($session, 'administrateur');

        $data = $request->request->all();
        $data['idUser'] = $user->getId();

        $article = new Article($data);
        $articleDAO = new ArticleDAO(self::$db, self::$cache);

        $result = $articleDAO->update($article);

        if($result) {
            $session->getFlashBag()->add('success', 'Article modifié');

            $response->setStatusCode(Response::HTTP_OK);
            return $response;
        }

        $session->getFlashBag()->add('error', 'Erreur lors de la modification de l\'article');

        $response->setStatusCode(Response::HTTP_BAD_REQUEST);
        return $response;
    }
}