<?php

namespace Core\Smoky;

use Symfony\Component\HttpFoundation\{Request, Response};
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpKernel\Controller\{
    ArgumentResolver, ArgumentResolverInterface, ControllerResolver, ControllerResolverInterface
};
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;

class Smoky implements Smokyinterface
{

    /** @var  UrlMatcher */
    protected $urlMatcher;

    /** @var  ControllerResolver */
    protected $controllerResolver;

    /** @var  ArgumentResolver */
    protected $argumentResolver;

    /**
     * Smoky constructor.
     *
     * @param UrlMatcher|UrlMatcherInterface $urlMatcher
     * @param ControllerResolver|ControllerResolverInterface $controllerResolver
     * @param ArgumentResolver|ArgumentResolverInterface $argumentResolver
     */

    public function __construct(UrlMatcherInterface $urlMatcher, ControllerResolverInterface $controllerResolver, ArgumentResolverInterface $argumentResolver)
    {
        $this->urlMatcher = $urlMatcher;
        $this->controllerResolver = $controllerResolver;
        $this->argumentResolver = $argumentResolver;
    }

    /**
     * Allow to handle a request and find the Controller linked to this one.
     *
     * @param Request $request
     * @return mixed
     */

    public function handle(Request $request)
    {
        try {
            $request->attributes->add($this->urlMatcher->match($request->getPathInfo()));

            $controller = $this->controllerResolver->getController($request);
            $arguments = $this->argumentResolver->getArguments($request, $controller);

            return call_user_func_array($controller, $arguments);
        } catch (ResourceNotFoundException $e) {
            ob_start();
            include __DIR__.'/../resources/views/not-found/404.html';
            $response = new Response(ob_get_clean());
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
            return $response;
        } catch (\Exception $e) {
            return new Response('An error occurred', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}