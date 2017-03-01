<?php

namespace Core\Controller;

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
            'cache' => false,
            'debug' => true
        ));
        $twig->addExtension(new Twig_Extension_Debug());

        extract($request->attributes->all(), EXTR_SKIP);
        ob_start();
        //include sprintf(__DIR__ . '/../../resources/views/%s.php', $_route);
        echo $twig->render(sprintf('%s.twig', $_route), array('request' => $request));

        return new Response(ob_get_clean());
    }
}