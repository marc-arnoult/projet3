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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class CommentController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function indexAction (Request $request) : Response
    {
        $session = $this->getSession();
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
     * @return void
     */
    public function postAction (Request $request)
    {
        $session = $this->getSession();

        $commentDAO = new CommentDAO(self::$db, self::$cache);

        $user = $session->get('user');
        $data = $request->request->all();
        $http_referer = $request->server->get('HTTP_REFERER');

        if (isset($data) && !empty($user)) {
            $comment = new Comment($data);
            $comment->setId_user($user->getId());
            $result = $commentDAO->add($comment);

            if($result) {
                $session->getFlashBag()->add('success', 'Commentaire bien ajouté');

                header("Location: {$http_referer}");
                return null;
            }

            $session->getFlashBag()->add('error', 'Erreur lors de l\'ajout du commentaire');

            header("Location: {$http_referer}");
            return null;
        }

        $session->getFlashBag()->add('error', 'Vous n\'êtes pas enregistré ou le commentaire est vide');

        header("Location: {$http_referer}");
        return null;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function responseAction (Request $request) : Response
    {
        $session = $this->getSession();
        $response = new Response();
        $commentDAO = new CommentDAO(self::$db, self::$cache);

        $user = $session->get('user');
        $data = $request->request->all();

        if(isset($data) && !empty($user)) {
            $comment = new Comment($data);
            $comment->setId_user($user->getId());
            $result = $commentDAO->add($comment);

            if($result) {
                $session->getFlashBag()->add('success', 'Commentaire bien ajouté');

                $response->setStatusCode(Response::HTTP_CREATED);
                return $response;
            }

            $session->getFlashBag()->add('error', 'Erreur lors de l\'ajout du commentaire');

            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
            return $response;
        }

        $session->getFlashBag()->add('error', 'Vous ne pouvez pas supprimer ce commentaire');

        $response->setStatusCode(Response::HTTP_UNAUTHORIZED);
        return $response;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function deleteAction (Request $request) : Response
    {
        $session = $this->getSession();
        $response = new Response();

        $commentDAO = new CommentDAO(self::$db, self::$cache);

        $user = $session->get('user');
        $idComment = $request->request->get('id');
        $comment = $commentDAO->get($idComment);

        if($user->getRole() == 'administrateur' || $comment->id_user == $user->getId()) {
            $result = $commentDAO->delete($idComment);
            if($result) {
                $session->getFlashBag()->add('success', 'Commentaire supprimé');

                $response->setStatusCode(Response::HTTP_OK);
                return $response;
            }

            $session->getFlashBag()->add('error', 'Erreur lors de la suppresion du commentaire');

            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
            return $response;
        }

        $session->getFlashBag()->add('error', 'Vous ne pouvez pas supprimer ce commentaire');

        $response->setStatusCode(Response::HTTP_UNAUTHORIZED);
        return $response;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function editAction (Request $request) : Response
    {
        $session = $this->getSession();
        $response = new Response();
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
                    $session->getFlashBag()->add('success', 'Commentaire modéré');

                    $response->setStatusCode(Response::HTTP_OK);
                    return $response;
                }
            }


            if($result) {
                $session->getFlashBag()->add('success', 'Commentaire bien modifié');

                $response->setStatusCode(Response::HTTP_OK);
                return $response;
            }

            $session->getFlashBag()->add('error', 'Erreur lors de la modification du commentaire');

            $response->setStatusCode(Response::HTTP_UNAUTHORIZED);
            return $response;
        }

        $session->getFlashBag()->add('error', 'Vous ne pouvez pas éditer le commentaire');

        $response->setStatusCode(Response::HTTP_UNAUTHORIZED);
        return $response;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function reportAction (Request $request) : Response
    {
        $session = $this->getSession();
        $response = new Response();

        $idComment = $request->request->get('id');
        $hisReported = $request->cookies->get('Report'.$idComment);

        if($hisReported) {
            $session->getFlashBag()->add('error', 'Vous avez déjà signalé ce commentaire');

            $response->setStatusCode(Response::HTTP_ALREADY_REPORTED);
            return $response;
        }

        $commentDAO = new CommentDAO(self::$db, self::$cache);

        $result = $commentDAO->addReport($idComment);

        if($result) {
            $session->getFlashBag()->add('success', 'Commentaire signalé, merci.');

            $response = new Response();
            $response->setStatusCode(Response::HTTP_OK);
            $response->headers->setCookie(new Cookie('Report'.$idComment, true));
            return $response;
        }

        $session->getFlashBag()->add('error', 'Erreur lors du signalement.');

        $response->setStatusCode(Response::HTTP_BAD_REQUEST);
        return $response;
    }
}