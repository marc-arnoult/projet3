<?php

namespace Core\Smoky;

use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpKernel\Controller\{
    ArgumentResolverInterface, ControllerResolver, ArgumentResolver, ControllerResolverInterface
};
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;

interface Smokyinterface
{
    /**
     *SmokyInterface constructor.
     *
     * @param UrlMatcher|UrlMatcherInterface $urlMatcher
     * @param ControllerResolver|ControllerResolverInterface $controllerResolver
     * @param ArgumentResolver|ArgumentResolverInterface $argumentResolver
     */
    public function __construct(
        UrlMatcherInterface $urlMatcher,
        ControllerResolverInterface $controllerResolver,
        ArgumentResolverInterface $argumentResolver
    );

    /**
     * Allow to handle a request and find the Controller linked to this one.
     *
     * @param Request $request
     * @return mixed
     */
    public function handle(Request $request);
}