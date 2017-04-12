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

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function signUpShowAction(Request $request) : Response
    {
        $request->setSession($this->getSession());
        return $this->render($request);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function signUpAction(Request $request)
    {
        $session = $this->getSession();
        $response = new Response();

        $data = $request->request->all();

        if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $session->getFlashBag()->add('error', 'Email incorrect');

            $response->setStatusCode(Response::HTTP_NOT_ACCEPTABLE);
            return $response;
        }

        $userDAO = new UserDAO(self::$db, self::$cache);
        $user = new User($data);

        $result = $userDAO->add($user);

        if(!$result) {
            $session->getFlashBag()->add('error', 'Pseudo et/ou adresse email déjà utilisé');

            $response->setStatusCode(Response::HTTP_NOT_ACCEPTABLE);
            return $response;
        }

        $session->getFlashBag()->add('success', 'Inscription terminée, merci.');

        return static::signInAction($request);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function signInShowAction(Request $request) : Response
    {
        $request->setSession($this->getSession());

        return $this->render($request);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function signInAction(Request $request)
    {
        $session = $this->getSession();
        $response = new Response();

        $data = $request->request->all();
        $data['password'] = sha1($data['password']);

        $userDAO = new UserDAO(self::$db, self::$cache);
        $result = $userDAO->get($data);

        if (!$result) {
            $session->getFlashBag()->set('error', 'Mauvais pseudo ou mot de passe');

            $response->setStatusCode(401);
            return $response;
        }

        $user = new User($result);
        $session->set('user', $user);

        if ($user->getRole() === 'administrateur') {
            $session->getFlashBag()->add('success', 'Vous êtes maintenant connectée en tant que administrateur');

            $response->setStatusCode(Response::HTTP_OK);
        } else if (!empty($user->getRole())) {
            $session->getFlashBag()->add('success', 'Vous êtes maintenant connectée');

            $response->setStatusCode(Response::HTTP_OK);
        }

        return $response;
    }

    /**
     * @param Request $request
     * @return void
     */
    public function signOutAction(Request $request)
    {
        $session = $this->getSession();
        $session->clear();
        $session->getFlashBag()->add('success', 'Vous êtes maintenant déconnectée');

        header('Location: /');
        return null;
    }
}