<?php

namespace App\Handler\Person;

use App\BaseProject\BaseController;
use App\Service\PersonService;

use JMS\Serializer\SerializerBuilder;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class FindPersonHandler extends BaseController
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
        $personObject = $this->personService->findPerson($args['id']);

        $serializer = SerializerBuilder::create()->build();
        $personArray = json_decode($serializer->serialize($personObject, 'json'),true);

        return $response->withJSON($personArray,200,JSON_PRETTY_PRINT);
    }
}