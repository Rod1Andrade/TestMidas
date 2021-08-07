<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$twig = Twig::create(__DIR__ . '/../src/App/views', ['cache' => false]);

$app->get('/question1', function (Request $request, Response $response, $args) {
    $view = Twig::fromRequest($request);
    return $view->render($response, 'content.html', [
        'name' => 'Rodrigo Andrade'
    ]);
});


$app->add(\Slim\Views\TwigMiddleware::create($app, $twig));
$app->run();
