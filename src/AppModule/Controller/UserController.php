<?php


namespace AppModule\Controller;


use AppModule\Model\UserDAO;
use Core\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Request $request) : Response
    {
        $session = $this->getSession();
        $this->userRoleIs($session, 'administrateur');

        $messages = $session->getFlashBag()->all() ?? null;

        $userDAO = new UserDAO(self::$db, self::$cache);
        $users = $userDAO->getAll();

        $request->attributes->set('users', $users);
        $request->attributes->set('messages', $messages);

        return $this->render($request);
    }

    public function deleteAction(Request $request) : Response
    {
        $session = $this->getSession();
        $this->userRoleIs($session, 'administrateur');

        $id = $request->request->get('id');
        $userDAO = new UserDAO(self::$db, self::$cache);

        $result = $userDAO->delete($id);

        if($result) {
            $session->getFlashBag()->add('success', 'Utilisateur supprimé');

            return new Response('Utilisateur supprimé');
        }
        $session->getFlashBag()->add('error', 'Erreur lors de la suppression de cet utilisateur');

        return new Response('Erreur lors de la suppression de cet utilisateur');
    }
}