<?php


namespace AppModule\Controller;


use AppModule\Model\UserDAO;
use Core\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function usersShowAction(Request $request)
    {
        $userDAO = new UserDAO();
        $users = $userDAO->getAll();

        $request->attributes->set('users', $users);

        return $this->render($request);
    }
}