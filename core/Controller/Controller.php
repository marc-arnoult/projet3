<?php

namespace Core\Controller;

use AppModule\Model\User;
use DateTime;
use Symfony\Component\HttpFoundation\{Request, Response};
use Twig_Environment;
use Twig_Extension_Debug;
use Twig_Loader_Filesystem;

class Controller
{
    public function render(Request $request) : Response
    {
        $loader = new Twig_Loader_Filesystem(array(
            __DIR__ .'/../../resources/views',
            __DIR__ .'/../../resources/views/layout',
            __DIR__ .'/../../resources/views/admin',
            __DIR__ .'/../../resources/views/admin/layout'));
        $twig = new Twig_Environment($loader, array(
            'cache' => __DIR__ .'/../../tmp'
        ));
        $twig->addExtension(new Twig_Extension_Debug());
        $twig->addExtension(new \Twig_Extensions_Extension_Text());

        extract($request->attributes->all(), EXTR_SKIP);

        ob_start();
        echo $twig->render(sprintf('%s.twig', $_route), array('request' => $request));
        $response = new Response(ob_get_clean());

        $date = new DateTime();
        $date->modify('+600 seconds');

        $response->setPublic();
        $response->setPrivate();
        $response->setMaxAge(600);
        $response->setSharedMaxAge(3600);
        $response->headers->addCacheControlDirective('must-revalidate', true);

        return $response;
    }

    public function userRoleIs($user, string $role) {
        if($user instanceof User && $user->getRole() === $role) {
            return true;
        }
        return false;
    }
}