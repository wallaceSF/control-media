<?php

namespace App\Handler\Person;

use App\BaseProject\BaseController;
use App\Service\PersonService;
use App\ValueObject\InfoLoanVO;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
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

    public function __construct(PersonService $personService)
    {
        $this->personService = $personService;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return ResponseInterface
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws JsonMapper_Exception
     */
    public function handle(Request $request, Response $response, array $args): ResponseInterface
    {
        $r = ['name' => 'Wallace', 'dateOfBirth' => '2019-12-01'];

        /** @var InfoLoanVO $personVO */
        $personVO = (new JsonMapper())->map(json_decode(json_encode($r)), new InfoLoanVO());
        $this->personService->createPerson($personVO);

        return $response->withJSON([],201,JSON_PRETTY_PRINT);
    }
}


//se nao tiver registro na tabela de emprestimo, está disponivel
//se tiver registro na tabela emprestimo e o status for disponivel entao é disponivel oras