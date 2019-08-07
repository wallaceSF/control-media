<?php

namespace App\Handler\Person;

use App\BaseProject\BaseController;
use App\Domain\Service\PersonService;
use App\Domain\ValueObject\InfoLoanVO;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use JsonMapper;
use JsonMapper_Exception;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class UpdatePersonHandler extends BaseController
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
     * @throws JsonMapper_Exception
     */
    public function handle(Request $request, Response $response, array $args): ResponseInterface
    {
        $r = ['id' => 1, 'title' => 'Teste Livro', 'description' => 'Livro exemplo', 'type' => 1];

        /** @var InfoLoanVO $personVO */
        $personVO = (new JsonMapper())->map(json_decode(json_encode($r)), new InfoLoanVO());
        $this->personService->updatePerson($personVO);
        return $response->withJSON([],201,JSON_PRETTY_PRINT);
    }
}
