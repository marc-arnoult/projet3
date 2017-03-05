<?php
/**
 * Created by PhpStorm.
 * User: marc
 * Date: 11/02/2017
 * Time: 12:40
 */

namespace AppModule\Controller;

use AppModule\Model\Article;
use AppModule\Model\ArticleDAO;
use AppModule\Model\UserDAO;
use Core\Controller\Controller;
use Core\Database\Database;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class AdminController extends Controller
{
    public function indexAction(Request $request)
    {
        $session = new Session();
        $user = $session->get('user') ?? 'Anonyme';
        if ($user->getRole() !== 'administrateur') {
            header('Location: /');
        } else {
            $userDAO = new UserDAO();
            $articleDAO = new ArticleDAO();
            $nbUser = $userDAO->getCountUser()->nbUser;
            $nbArticle = $articleDAO->getCountUser()->nbArticle;

            $request->attributes->set('nbArticle', $nbArticle);
            $request->attributes->set('nbUser', $nbUser);
            $request->setSession($session);
            return $this->render($request);
        }
    }
    public function articleAction(Request $request)
    {
        $session = new Session();
        $userDAO = new UserDAO();
        $articleDAO = new ArticleDAO();
        $nbUser = $userDAO->getCountUser()->nbUser;
        $nbArticle = $articleDAO->getCountUser()->nbArticle;

        $request->attributes->set('nbArticle', $nbArticle);
        $request->attributes->set('nbUser', $nbUser);
        $request->setSession($session);
        return $this->render($request);
    }
    public function articlePostAction(Request $request)
    {
        $session = new Session();
        $user = $session->get('user');

        if($user->getRole() === 'administrateur') {
            $data = array();
            $data['content'] = $request->request->get('content');
            $data['idUser'] = $user->getId();

            $article = new Article($data);
            $articleDAO = new ArticleDAO();

            $result = $articleDAO->add($article);
        } else {
            echo 'Wrong';
        }
    }

}