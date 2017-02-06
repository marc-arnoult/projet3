<?php

namespace AppModule\Controller;

use Core\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    public function indexAction(Request $request)
    {
        return $this->render($request);
    }
    public function byeAction(Request $request)
    {
        return $this->render($request);
    }
}