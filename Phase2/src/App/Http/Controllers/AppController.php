<?php

namespace Rodri\Phase2\App\Http\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Rodri\Phase2\App\Repositories\AppRepository;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * App Controller
 * @author Rodrigo Andrade
 */
class AppController
{

    public function __construct(
        private AppRepository $repository
    )
    {
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param          $args
     * @return Response|null
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function menuContent(Request $request, Response $response, $args): null|Response
    {
        $view = Twig::fromRequest($request);
        $data = $this->repository->loadMenuContent($request->getAttribute('imobiliariaId', 0));

        return $view->render($response, 'content.twig.html', [
            'data' => $data
        ]);
    }

}