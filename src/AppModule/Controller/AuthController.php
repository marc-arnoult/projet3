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
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class AuthController extends Controller
{
    public function signUpShowAction(Request $request)
    {
        return $this->render($request);
    }
    public function signUpAction(Request $request)
    {
        $data = $request->request->all();
        $user = new User($data);
        $userDAO = new UserDAO();
        $result = $userDAO->add($user);
        if($result) {
            echo 'Utilisateur bien ajouté';
        }
    }
    public function signInShowAction(Request $request)
    {
        return $this->render($request);
    }

    public function signInAction(Request $request)
    {
        $data = $request->request->all();
        $userDAO = new UserDAO();
        $result = $userDAO->get($data['pseudo'], $data['password']);
        if (!$result) {
            header('Location: /');
        }
        $user = new User($result);
        $session = new Session();
        $session->set('user', $user);
    }

    public function signOutAction(Request $request)
    {
        $session = new Session();
        $session->clear();

    }
}