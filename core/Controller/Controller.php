<?php

namespace Core\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Controller
{
    public function render(Request $request)
    {
        //extract($request->attributes->all(), EXTR_SKIP);
        ob_start();
        var_dump($request->attributes->all());
        die();
        include sprintf(__DIR__.'/../../web/views/%s.php', $_route);

        return new Response(ob_get_clean());
    }
}