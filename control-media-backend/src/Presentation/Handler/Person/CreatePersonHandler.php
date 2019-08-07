<?php

namespace App\Presentation\Handler\Person;

use App\Application\Service\MediaApplicationService;
use App\Application\Service\PersonApplicationService;
use App\BaseProject\BaseController;
use App\Domain\Service\PersonService;
use App\Domain\ValueObject\PersonVO;
use JsonMapper;
use JsonMapper_Exception;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class CreatePersonHandler extends BaseController
{
    /**
     * @var PersonService
     */
    private $personService;

    public function __construct(PersonApplicationService $personService)
    {
        $this->personService = $personService;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return ResponseInterface
     * @throws JsonMapper_Exception
     */
    public function handle(Request $request, Response $response, array $args): ResponseInterface
    {
        $personVO = (new JsonMapper())->map(json_decode($request->getBody()->getContents()), new PersonVO());
        $this->personService->createPerson($personVO);

        return $response->withJSON([],201,JSON_PRETTY_PRINT);
    }
}
