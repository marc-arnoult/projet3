<?php

namespace AppModule\Controller;

use Core\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    public function indexAction(Request $request)
    {
        return $this->render($request);
    }
}