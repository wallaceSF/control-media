<?php

namespace App\Application\Service;

use App\Domain\Service\PersonService;

class PersonApplicationService
{
    /**
     * @var PersonService
     */
    private $personService;

    public function __construct(PersonService $personService)
    {
        $this->personService = $personService;
    }

    public function createPerson($t)
    {
        return $this->personService->createPerson($t);
    }
}
