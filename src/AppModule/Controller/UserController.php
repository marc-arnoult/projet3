<?php


namespace AppModule\Controller;


use AppModule\Model\UserDAO;
use Core\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function usersShowAction(Request $request)
    {
        $session = new Session();
        $this->userRoleIs($session, 'administrateur');

        $userDAO = new UserDAO();
        $users = $userDAO->getAll();

        $request->attributes->set('users', $users);

        return $this->render($request);
    }
}