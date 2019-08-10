<?php

namespace App\Presentation\Handler\Person;

use App\Application\Service\PersonApplicationService;
use App\BaseProject\BaseController;
use JMS\Serializer\SerializerBuilder;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class FindPersonHandler extends BaseController
{

    private $personService;

    /**
     * FindPersonHandler constructor.
     * @param PersonApplicationService $personService
     */
    public function __construct(PersonApplicationService $personService)
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

        if(is_null($personObject)){
            $personObject = [];
        }

        $serializer = SerializerBuilder::create()->build();
        $personArray = json_decode($serializer->serialize($personObject, 'json'),true);

        return $response->withJSON($personArray,200,JSON_PRETTY_PRINT);
    }
}