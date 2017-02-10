<?php

namespace Core\Controller;

use Symfony\Component\HttpFoundation\{Request, Response};

class Controller
{
    public function render(Request $request) : Response
    {
        extract($request->attributes->all(), EXTR_SKIP);
        ob_start();
        include sprintf(__DIR__ . '/../../resources/views/%s.php', $_route);

        return new Response(ob_get_clean());
    }
}