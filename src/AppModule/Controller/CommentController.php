<?php
/**
 * Created by PhpStorm.
 * User: marc
 * Date: 20/02/2017
 * Time: 11:54
 */

namespace AppModule\Controller;


use AppModule\Model\Comment;
use AppModule\Model\CommentDAO;
use Core\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class CommentController extends Controller
{
    public function postAction (Request $request)
    {
        $session = new Session();
        $commentDAO = new CommentDAO();

        $user = $session->get('user');
        $data = $request->request->all();

        if (isset($data)) {
            $comment = new Comment($data);
            $comment->setId_user($user->getId());
            $commentDAO->add($comment);
            $http_referer = $request->server->get('HTTP_REFERER');
            header("Location: {$http_referer}");
        }
    }

    public function responseAction (Request $request)
    {
        $session = new Session();
        $commentDAO = new CommentDAO();
        $comments = $commentDAO->getAll(1);

        $user = $session->get('user');
        $data = $request->request->all();

        return new JsonResponse($data);
    }
}