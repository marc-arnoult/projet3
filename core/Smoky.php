<?php

namespace Core\Smoky;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

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
     * @param UrlMatcher $urlMatcher
     * @param ControllerResolver $controllerResolver
     * @param ArgumentResolver $argumentResolver
     * @param ArgumentResolver $argumentResolver
     */

    public function __construct(UrlMatcher $urlMatcher, ControllerResolver $controllerResolver, ArgumentResolver $argumentResolver)
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
        $this->urlMatcher->getContext()->fromRequest($request);

        try {
            $request->attributes->add($this->urlMatcher->match($request->getPathInfo()));

            $controller = $this->controllerResolver->getController($request);
            $arguments = $this->argumentResolver->getArguments($request, $controller);

            return call_user_func_array($controller, $arguments);
        } catch (ResourceNotFoundException $e) {
            return new Response('Not Found', 404);
        } catch (\Exception $e) {
            return new Response('An error occurred', 500);
        }
    }

}