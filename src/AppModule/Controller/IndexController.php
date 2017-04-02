<?php

namespace AppModule\Controller;

use AppModule\Model\ArticleDAO;
use AppModule\Model\CommentDAO;
use Core\Controller\Controller;

use Core\Database\Database;
use Core\Database\RedisCache;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class IndexController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request) : Response
    {
        $session = new Session();

        $commentDAO = new CommentDAO(self::$db, self::$cache);
        $articleDAO = new ArticleDAO(self::$db, self::$cache);

        $articles = $articleDAO->getAllPublished(1);
        $lastComments = $commentDAO->getLast(3);

        $messages = $session->getFlashBag()->all() ?? null;

        $request->attributes->set('lastComments', $lastComments);
        $request->attributes->set('articles', array_reverse($articles));
        $request->attributes->set('commentDAO', $commentDAO);
        $request->attributes->set('messages', $messages);
        $request->setSession($session);

        return $this->render($request);
    }

    public function sendMailAction(Request $request)
    {
        $data = $request->request->all();
        ini_set('display_errors', 1);

        $mail = new \PHPMailer();
        $mail->Host = 'mailer';
        $mail->isSendmail();

        $mail->setFrom('myapp.dev');
        $mail->addAddress('marc.arnoult@hotmail.fr');

        $mail->Body     = $data['message'];
        if(!$mail->send()) {
            echo 'Message was not sent.';
            echo 'Mailer error: ' . $mail->ErrorInfo;
        } else {
            return new Response('Message has been sent.');
        }
    }

}