<?php

namespace AppModule\Controller;

use Core\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    public function indexAction(Request $request)
    {
        $title = 'marc';
        return $this->render($request, compact('title'));
    }
    public function byeAction(Request $request, $name)
    {
        return $this->render($request, $name);
    }
}