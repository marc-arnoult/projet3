<?php

namespace Core\Controller;

use AppModule\Model\User;
use Core\Database\Database;
use Core\Database\RedisCache;
use DateTime;
use Symfony\Component\HttpFoundation\{
    Request, Response, Session\Session
};
use Twig_Environment;
use Twig_Extension_Debug;
use Twig_Loader_Filesystem;

class Controller
{
    protected static $db;
    protected static $cache;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        if (empty(self::$cache)) {
           self::$cache = new RedisCache();
        }

        if (empty(self::$db)) {
            self::$db = new Database();
        }
    }

    /**
     * Use twig for rendering the template with the twig associate to the request uri
     *
     * @param Request $request
     * @return Response
     */
    public function render(Request $request) : Response
    {
        $loader = new Twig_Loader_Filesystem(array(
            __DIR__ .'/../../resources/views',
            __DIR__ .'/../../resources/views/articles',
            __DIR__ .'/../../resources/views/register',
            __DIR__ .'/../../resources/views/home',
            __DIR__ .'/../../resources/views/comments',
            __DIR__ .'/../../resources/views/admin',
            __DIR__ .'/../../resources/views/admin/layout'
        ));
        $twig = new Twig_Environment($loader, array(
            'cache' => __DIR__ .'/../../tmp/'
        ));
        $twig->addExtension(new \Twig_Extensions_Extension_Text());

        extract($request->attributes->all(), EXTR_SKIP);

        ob_start();
        echo $twig->render(sprintf('%s.twig', $_route), array('request' => $request));
        $response = new Response(ob_get_clean());

        $response->setPublic();
        $response->setPrivate();

        $response->setSharedMaxAge(3600);
        $response->headers->addCacheControlDirective('must-revalidate', true);

        return $response;
    }

    /**
     * Check is the the user can do something.
     *
     * @param Session $session
     * @param $roles
     * @return bool
     */
    public function userRoleIs(Session $session, $roles) {
        $user = $session->get('user');

        if (is_array($roles)) {
            foreach ($roles as $role) {
                if($user->getRole() == $role) {
                    return true;
                }
            }

            $session
                ->getFlashBag()
                ->add('error', 'Vous n\'êtes pas autorisé à faire ça');
            header('Location: /');
            exit();
        }

        if ($user instanceof User && $user->getRole() === $roles) {
            return true;
        }

        $session
            ->getFlashBag()
            ->add('error', 'Vous n\'êtes pas autorisé à faire ça');
        header('Location: /');
        exit();
    }
}