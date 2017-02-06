<?php

namespace Core\Smoky;

use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpFoundation\Request;

interface Smokyinterface
{
    /**
     *SmokyInterface constructor.
     *
     * @param UrlMatcher $urlMatcher
     * @param ControllerResolver $controllerResolver
     * @param ArgumentResolver $argumentResolver
     */
    public function __construct(
        UrlMatcher $urlMatcher,
        ControllerResolver $controllerResolver,
        ArgumentResolver $argumentResolver
    );

    /**
     * Allow to handle a request and find the Controller linked to this one.
     *
     * @param Request $request
     * @return mixed
     */
    public function handle(Request $request);
}