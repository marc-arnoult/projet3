<?php
require_once __DIR__ . '/app/autoload.php';
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpKernel\Controller\{ControllerResolver, ArgumentResolver};
use Predis\Client;

$request = Request::createFromGlobals();
$routes  = include __DIR__ . '/app/Routes/routes.php';

$context = new RequestContext();
$context->fromRequest($request);
$matcher = new UrlMatcher($routes, $context);

$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

$smoky = new \Core\Smoky\Smoky($matcher, $controllerResolver, $argumentResolver);
$response = $smoky->handle($request);


$response->send();
