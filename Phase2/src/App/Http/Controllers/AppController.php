<?php

namespace Rodri\Phase2\App\Http\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class AppController
{

    /**
     * @param Request  $request
     * @param Response $response
     * @param          $args
     * @return Response|null
     */
    public function content(Request $request, Response $response, $args): null|Response
    {
        $view = Twig::fromRequest($request);
        return $view->render($response, 'content.html', [
            'name' => 'Rod'
        ]);
    }

}