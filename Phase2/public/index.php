<?php

use DI\Container;
use Rodri\Phase2\App\Http\Controllers\AppController;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use Slim\Views\Twig;

require __DIR__ . '/../vendor/autoload.php';

# Load dot env configuration
$dotEnv = \Dotenv\Dotenv::createUnsafeImmutable(__DIR__.'/../');
$dotEnv->load();

# Slim framework config
$container = new Container();
AppFactory::setContainer($container);
$app = AppFactory::create();

# View template
$twig = Twig::create(__DIR__ . '/../src/App/views', ['cache' => false]);
$app->add(\Slim\Views\TwigMiddleware::create($app, $twig));

# Routes
$app->group('/phase2', function (RouteCollectorProxy $group) {
    $group->get('/question1/{imobiliariaId}',  [AppController::class, 'menuContent']);
});

# App configuration
$app->run();
