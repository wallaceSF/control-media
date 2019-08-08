<?php

namespace App\BaseProject;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

abstract class BaseController
{
    function __invoke(Request $request, Response $response, array $args): ResponseInterface
    {
        try {
            return $this->handle($request, $response, $args);
        } catch (\Exception $e) {
            $statusCode = ($e->getCode() > 100) ? $e->getCode() : 500;
            return $response->withJSON([$e->getMessage()], $statusCode,JSON_PRETTY_PRINT);
        }
    }

    abstract public function handle(Request $request, Response $response, array $args): ResponseInterface;
}
