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
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class CommentController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function indexAction (Request $request)
    {
        $session = new Session();
        $this->userRoleIs($session, 'administrateur');

        $commentDAO = new CommentDAO(self::$db, self::$cache);

        $reportedComments = $commentDAO->getAllWithReport();

        $messages = $session->getFlashBag()->all() ?? null;
        $user = $session->get('user');

        $request->attributes->set('user', $user);
        $request->attributes->set('comments', $reportedComments);
        $request->attributes->set('messages', $messages);

        return $this->render($request);
    }

    /**
     * @param Request $request
     */
    public function postAction (Request $request)
    {
        $session = new Session();
        $commentDAO = new CommentDAO(self::$db, self::$cache);

        $user = $session->get('user');
        $data = $request->request->all();
        $http_referer = $request->server->get('HTTP_REFERER');

        if (isset($data) && !empty($user)) {
            $comment = new Comment($data);
            $comment->setId_user($user->getId());
            $result = $commentDAO->add($comment);

            if($result) {
                $session
                    ->getFlashBag()
                    ->add('success', 'Commentaire bien ajouté');

                header("Location: {$http_referer}");
                exit();
            }

            $session
                ->getFlashBag()
                ->add('error', 'Erreur lors de l\'ajout du commentaire');

            header("Location: {$http_referer}");
            exit();
        }

        $session
            ->getFlashBag()
            ->add('error', 'Vous n\'êtes pas enregistré ou le commentaire est vide');

        header("Location: {$http_referer}");
        exit();

    }

    /**
     * @param Request $request
     * @return Response
     */
    public function responseAction (Request $request)
    {
        $session = new Session();
        $commentDAO = new CommentDAO(self::$db, self::$cache);

        $user = $session->get('user');
        $data = $request->request->all();

        if(isset($data) && !empty($user)) {
            $comment = new Comment($data);
            $comment->setId_user($user->getId());
            $result = $commentDAO->add($comment);

            if($result) {
                $session
                    ->getFlashBag()
                    ->add('success', 'Commentaire bien ajouté');

                return new Response('Commentaire bien ajouté');
            }

            $session
                ->getFlashBag()
                ->add('error', 'Erreur lors de l\'ajout du commentaire');

            return new Response('Erreur lors de l\'ajout du commentaire');

        }

        $session
            ->getFlashBag()
            ->add('error', 'Erreur lors de l\'ajout du commentaire');

        return new Response('Erreur lors de l\'ajout du commentaire');
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function deleteAction (Request $request)
    {
        $session = new Session();
        $commentDAO = new CommentDAO(self::$db, self::$cache);

        $user = $session->get('user');
        $idComment = $request->request->get('id');
        $comment = $commentDAO->get($idComment);

        if($user->getRole() == 'administrateur' || $comment->id_user == $user->getId()) {
            $result = $commentDAO->delete($idComment);
            if($result) {
                $session
                    ->getFlashBag()
                    ->add('success', 'Commentaire supprimé');
                return new Response('Commentaire supprimé');
            }

            $session
                ->getFlashBag()
                ->add('error', 'Erreur lors de la suppresion du commentaire');
            return new Response('Erreur lors de la suppresion du commentaire');
        }

        $session
            ->getFlashBag()
            ->add('error', 'Vous ne pouvez pas supprimer ce commentaire');

        return new Response('Vous ne pouvez pas supprimer ce commentaire\'');
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function editAction (Request $request)
    {
        $session = new Session();
        $user = $session->get('user');

        $this->userRoleIs($session, ['administrateur', 'lecteur']);

        $commentDAO = new CommentDAO(self::$db, self::$cache);

        $data = $request->request->all();
        $data['id_user'] = $user->getId();

        $newComment = new Comment($data);
        $comment = $commentDAO->get($data['id']);

        if($comment->id_user == $user->getId() || $this->userRoleIs($session, 'administrateur')) {
            $result = $commentDAO->update($newComment);

            if($user->getRole() === 'administrateur') {
                $moderated = $commentDAO->deleteReportedComment($data['id']);

                if($moderated) {
                    $session
                        ->getFlashBag()
                        ->add('success', 'Commentaire modéré');

                    return new Response('Commentaire modéré');
                }
            }


            if($result) {
                $session
                    ->getFlashBag()
                    ->add('success', 'Commentaire bien modifié');

                return new Response('Commentaire bien modifié');
            }

            $session
                ->getFlashBag()
                ->add('error', 'Erreur lors de la modification du commentaire');

            return new Response('Erreur lors de la modification du commentaire');
        }

        $session
            ->getFlashBag()
            ->add('error', 'Vous ne pouvez pas éditer le commentaire');

        return new Response('Vous ne pouvez pas éditer le commentaire');
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function reportAction (Request $request)
    {
        $session = new Session();

        $idComment = $request->request->get('id');

        $hisReported = $request->cookies->get('Report'.$idComment);

        if($hisReported) {
            $session
                ->getFlashBag()
                ->add('error', 'Vous avez déjà signalé ce commentaire');

            return new Response('Vous avez déjà signalé ce commentaire');
        }

        $commentDAO = new CommentDAO(self::$db, self::$cache);

        $result = $commentDAO->addReport($idComment);

        if($result) {
            $session
                ->getFlashBag()
                ->add('success', 'Commentaire signalé, merci.');
            $response = new Response();
            $response->headers->setCookie(new Cookie('Report'.$idComment, true));

            return $response;
        }

        $session
            ->getFlashBag()
            ->add('error', 'Erreur lors du signalement.');

        exit();
    }
}