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

        $userDAO = new UserDAO();
        $user = new User($data);
        var_dump($user);
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
        $session = new Session();

        $data = $request->request->all();
        $userDAO = new UserDAO();
        $result = $userDAO->get($data['pseudo'], sha1($data['password']));

        if (!$result) {
            $session->getFlashBag()
                ->set('error', array
                ('error' => '<div class="alert alert-error">
                                    <span class="alert-text">Mauvais pseudo ou mot de passe</span>
                                    <span class="alert-remove">x</span>
                                </div>'));
            header('Location: /');
        }

        $user = new User($result);
        $session->set('user', $user);

        if($user->getRole() === 'administrateur') {
            $session->getFlashBag()->set('success', array('success' => 'Vous êtes maintenant connecté en tant que administrateur'));
            header('Location: /admin');
        }

        $session->getFlashBag()
            ->set('success', array
                 ('success' => '<div class="alert alert-success">
                                    <span class="alert-text">Vous êtes maintenant connecté</span>
                                    <span class="alert-remove">x</span>
                                </div>'));
        header('Location: /');
    }

    public function signOutAction(Request $request)
    {
        $session = new Session();
        $session->clear();
        header('Location: /');
    }
}