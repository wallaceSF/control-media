<?php

namespace App\Handler\Person;

use App\BaseProject\BaseController;
use App\Entity\Person;
use App\Service\MediaService;

use App\Service\PersonService;
use JMS\Serializer\SerializerBuilder;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class FindAllPersonHandler extends BaseController
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
        /** @var Person[] $listPerson */
        $listPerson = $this->personService->findAllPerson();

        $serializer = SerializerBuilder::create()->build();
        $listPersonArray = json_decode($serializer->serialize($listPerson, 'json'),true);

        return $response->withJSON($listPersonArray, 200, JSON_PRETTY_PRINT);
    }
}
