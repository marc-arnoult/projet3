<?php
namespace AppModule\Controller;

use Core\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{
    public function showAction(Request $request)
    {
        return $this->render($request);
    }
    public function testAction(Request $request)
    {
        return new Response('Coucou');
    }
}