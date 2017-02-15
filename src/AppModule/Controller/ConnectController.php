<?php
/**
 * Created by PhpStorm.
 * User: marc
 * Date: 14/02/2017
 * Time: 15:40
 */

namespace AppModule\Controller;


use AppModule\Model\User;
use AppModule\Model\UserDAO;
use Core\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ConnectController extends Controller
{
    public function indexAction(Request $request)
    {
        return $this->render($request);
    }
    public function signUpAction(Request $request)
    {
        $data = $request->request->all();
        $user = new User($data);
        $userDAO = new UserDAO();
        $userDAO->add($user);
    }
    public function signInAction()
    {
        $userDAO = new UserDAO();

    }

    public function signOutAction()
    {

    }
}