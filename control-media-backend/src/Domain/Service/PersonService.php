<?php

namespace App\Domain\Service;

use App\Domain\Contract\Infrastruture\Repository\PersonRepositoryInterface;
use App\Domain\Entity\Media;
use App\Domain\Entity\Person;
use App\Domain\ValueObject\PersonVO;
use DateTime;
use Exception;

class PersonService
{
    /**
     * @var PersonRepositoryInterface
     */
    private $personRepository;


    public function __construct(PersonRepositoryInterface $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    public function createPerson(PersonVO $mediaVO): ?Person {

        $mediaObject = new Person();
        $mediaObject->setName($mediaVO->name);
        $mediaObject->setDateOfBirth(new DateTime($mediaVO->dateOfBirth));

        $this->personRepository->persist($mediaObject);

        return $mediaObject;
    }



    /**
     * @param PersonVO $personVO
     * @return Person|null
     * @throws Exception
     */
    public function updatePerson(PersonVO $personVO): ?Person
    {
        /** @var Person $personObject */
        $personObject = $this->personRepository->find($personVO->id);

        if(empty($personObject)){
            throw new Exception('Pessoa não encontrada', 400);
        }

        $personObject->setName($personVO->name);
        $personObject->setDateOfBirth(new DateTime($personVO->dateOfBirth));

        $this->personRepository->persist($personObject);

        return $personObject;
    }


    /**
     * @param int $id
     * @return Person|null
     * @throws Exception
     */
    public function deletePerson(int $id) {
        $personObject = $this->personRepository->find($id);

        if(empty($personObject)) {
            throw new Exception('pessoa não encontrada', 400);
        }

        $this->personRepository->remove($personObject);
        return $personObject;
    }

    /**
     * @return Person[]|array
     */
    public function findAllPerson(): array
    {
        return $this->personRepository->findAll();
    }

    public function findPerson(int $id): ?Person
    {
        /** @var Person|null $personObject */
        $personObject = $this->personRepository->find($id);
        return $personObject;
    }
}
