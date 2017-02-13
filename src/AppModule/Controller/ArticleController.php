<?php
namespace AppModule\Controller;

use AppModule\Model\ArticleDAO;
use Core\Controller\Controller;
use Core\Database\Database;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends Controller
{

    public function indexAction(Request $request)
    {
        $db = new Database();
        $articles = $db->query('SELECT * FROM articles LIMIT 0, 5')->fetch(\PDO::FETCH_OBJ);
        $request->attributes->set('articles', $articles);
        return $this->render($request);
    }
    public function showAction(Request $request)
    {
        $db = new Database();
        $id = $request->get('id');
        $articles = $db->query('SELECT * FROM articles LIMIT 0, 5')->fetch(\PDO::FETCH_OBJ);
        $request->attributes->set('articles', $articles);
        return $this->render($request);
    }
}