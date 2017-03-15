<?php
/**
 * Created by PhpStorm.
 * User: marc
 * Date: 11/02/2017
 * Time: 12:40
 */

namespace AppModule\Controller;


use AppModule\Model\ArticleDAO;
use AppModule\Model\UserDAO;
use Core\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Session\Session;

class AdminController extends Controller
{
    public function indexAction(Request $request)
    {
        $session = new Session();
        $user = $session->get('user');
        $messages = $session->getFlashBag()->all() ?? null;
        $request->attributes->set('messages', $messages);

        if (!$this->userRoleIs($user, 'administrateur')) {
            $session
                ->getFlashBag()
                ->add('error', 'Vous n\'êtes pas autorisé à faire ça');
            header('Location: /');
            return false;
        } else {
            $userDAO = new UserDAO();
            $articleDAO = new ArticleDAO();
            $nbUser = $userDAO->getCountUser()->nbUser;
            $nbArticle = $articleDAO->getCountArticles()->nbArticle;

            $request->attributes->set('nbArticle', $nbArticle);
            $request->attributes->set('nbUser', $nbUser);
            $request->setSession($session);
            return $this->render($request);
        }
    }

}