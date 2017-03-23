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
    public function indexAction (Request $request)
    {
        $session = new Session();
        $commentDAO = new CommentDAO();

        $comments = $commentDAO->getAll();
        $reportedComments = $commentDAO->getAllWithReport();

        $messages = $session->getFlashBag()->all() ?? null;
        $user = $session->get('user');

        $request->attributes->set('user', $user);
        $request->attributes->set('comments', $reportedComments);
        $request->attributes->set('messages', $messages);

        return $this->render($request);
    }

    public function postAction (Request $request)
    {
        $session = new Session();
        $commentDAO = new CommentDAO();

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
            } else {
                $session
                    ->getFlashBag()
                    ->add('error', 'Erreur lors de l\'ajout du commentaire');
                header("Location: {$http_referer}");
            }
        } else {
            $session
                ->getFlashBag()
                ->add('error', 'Vous n\'êtes pas enregistré ou le commentaire est vide');
            header("Location: {$http_referer}");
        }
    }

    public function responseAction (Request $request)
    {
        $session = new Session();
        $commentDAO = new CommentDAO();

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
            } else {
                $session
                    ->getFlashBag()
                    ->add('error', 'Erreur lors de l\'ajout du commentaire');
            }
        } else {
            $session
                ->getFlashBag()
                ->add('error', 'Erreur');
        }
    }
    public function deleteAction (Request $request)
    {
        $session = new Session();
        $commentDAO = new CommentDAO();

        $user = $session->get('user');
        $idComment = $request->request->get('id');
        $comment = $commentDAO->get($idComment);

        if($this->userRoleIs($user, 'administrateur') || $comment->id_user == $user->getId()) {
            $result = $commentDAO->delete($idComment);
            if($result) {
                $session
                    ->getFlashBag()
                    ->add('success', 'Commentaire supprimé');
            } else {
                $session
                    ->getFlashBag()
                    ->add('error', 'Erreur lors de la suppresion du commentaire');
            }
        } else {
            $session
                ->getFlashBag()
                ->add('error', 'Vous ne pouvez pas supprimer ce commentaire');
        }

        return new Response();

    }

    public function editAction (Request $request)
    {
        $session = new Session();
        $commentDAO = new CommentDAO();

        $user = $session->get('user');
        $data = $request->request->all();
        $data['id_user'] = $user->getId();

        $newComment = new Comment($data);
        $comment = $commentDAO->get($data['id']);

        if($this->userRoleIs($user, 'administrateur') || $comment->id_user == $user->getId()) {
            $result = $commentDAO->update($newComment);

            if($result) {
                $session
                    ->getFlashBag()
                    ->add('success', 'Commentaire bien modifié');
            } else {
                $session
                    ->getFlashBag()
                    ->add('error', 'Erreur lors de la modification du commentaire');
            }
        } else {
            $session
                ->getFlashBag()
                ->add('error', 'Vous ne pouvez pas éditer le commentaire');
        }
    }

    public function reportAction (Request $request)
    {
        $session = new Session();
        $idComment = $request->request->get('id');
        $idArticle = $request->request->get('idArticle');

        $hisReported = $request->cookies->get('Report'.$idComment);

        if($hisReported) {
            $session
                ->getFlashBag()
                ->add('error', 'Vous avez déjà signalé ce commentaire');
            return new JsonResponse('Erreur');
        } else {
            $commentDAO = new CommentDAO();

            $result = $commentDAO->addReport($idComment);

            if($result) {
                $session
                    ->getFlashBag()
                    ->add('success', 'Commentaire signalé, merci.');
                $response = new Response();
                $response->headers->setCookie(new Cookie('Report'.$idComment, true));

                return $response;
            } else {
                $session
                    ->getFlashBag()
                    ->add('error', 'Erreur lors du signalement.');
            }
        }

    }
}