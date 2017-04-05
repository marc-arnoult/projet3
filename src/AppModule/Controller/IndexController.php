<?php

namespace AppModule\Controller;

use AppModule\Model\{ArticleDAO, CommentDAO};
use Core\Controller\Controller;

use Symfony\Component\HttpFoundation\{Request,Response};
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
        $session = new Session();

        $data = $request->request->all();

        if(!filter_var($data['from'], FILTER_VALIDATE_EMAIL)) {
            $session
                ->getFlashBag()
                ->add('error', 'Erreur email invalide');
            return new Response('Erreur email invalide');
        }

        $mail = new \PHPMailer();
        $mail->isSendmail();

        $mail->setFrom(htmlspecialchars($data['from']));
        $mail->addAddress('marc.arnoult@hotmail.fr');

        $mail->ContentType = 'text/plain';
        $mail->Subject     = htmlspecialchars($data['subject']);
        $mail->Body        = htmlspecialchars($data['message']);

        if(!$mail->send()) {
            $session
                ->getFlashBag()
                ->add('error', 'Erreur lors de l\'envoi du mail');
            return new Response('Erreur lors de l\'envoi du mail');
        } else {
            $session
                ->getFlashBag()
                ->add('success', 'Email envoyé merci');

            return new Response('Email envoyé merci');
        }
    }

}