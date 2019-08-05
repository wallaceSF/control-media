<?php

namespace App\Handler\Person;

use App\BaseProject\BaseController;
use App\Service\PersonService;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class DeletePersonHandler extends BaseController
{
    /**
     * @var PersonService
     */
    private $personService;

    /**
     * PersonController constructor.
     * @param PersonService $personService
     */
    public function __construct(PersonService $personService)
    {
        $this->personService = $personService;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return ResponseInterface
     */
    public function handle(Request $request, Response $response, array $args): ResponseInterface
    {
        $id = 2;
        $this->personService->deletePerson($id);

        return $response->withJSON([],201,JSON_PRETTY_PRINT);
    }
}
