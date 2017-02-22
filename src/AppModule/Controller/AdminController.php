<?php
/**
 * Created by PhpStorm.
 * User: marc
 * Date: 11/02/2017
 * Time: 12:40
 */

namespace AppModule\Controller;

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
            echo 'Wrong';
        } else {
            $request->setSession($session);
            return $this->render($request);
        }
    }

}