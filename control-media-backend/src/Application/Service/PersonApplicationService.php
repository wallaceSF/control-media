<?php

namespace App\Application\Service;

use App\Domain\Contract\Application\ConnectionApplicationInterface;
use App\Domain\Entity\Person;
use App\Domain\Service\PersonService;
use Exception;

class PersonApplicationService
{
    /**
     * @var PersonService
     */
    private $personService;
    /**
     * @var ConnectionApplicationInterface
     */
    private $connectionApplication;

    /**
     * PersonApplicationService constructor.
     * @param PersonService $personService
     * @param ConnectionApplicationInterface $connectionApplication
     */
    public function __construct(PersonService $personService, ConnectionApplicationInterface $connectionApplication)
    {
        $this->personService = $personService;
        $this->connectionApplication = $connectionApplication;
    }

    /**
     * @param $t
     * @return Person|null
     * @throws Exception
     */
    public function createPerson($t)
    {
        try {
            $this->connectionApplication->beginTransaction();
            $personObject = $this->personService->createPerson($t);
            $this->connectionApplication->commit();
            return $personObject;
        } catch (Exception $e) {
            $this->connectionApplication->rollback();
            throw $e;
        }
    }

    public function findPerson(int $id){
        return $this->personService->findPerson($id);
    }
}
