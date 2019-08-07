<?php

namespace App\BaseProject;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

abstract class BaseController
{
    function __invoke(Request $request, Response $response, array $args): ResponseInterface
    {
        return $this->handle($request, $response, $args);
    }

    abstract public function handle(Request $request, Response $response, array $args): ResponseInterface;
}
