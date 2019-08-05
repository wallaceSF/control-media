<?php

namespace App\Service;

use App\Entity\Person;
use App\ValueObject\PersonVO;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Exception;

class PersonService
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * MediaService constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param PersonVO $personVO
     * @return Person|null
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws Exception
     */
    public function createPerson(PersonVO $personVO): ?Person {
        $personObject = new Person();
        $personObject->setName($personVO->name);
        $personObject->setDateOfBirth(new DateTime($personVO->dateOfBirth));

        $this->entityManager->persist($personObject);
        $this->entityManager->flush();

        return $personObject;
    }

    /**
     * @param PersonVO $personVO
     * @return Person|null
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws Exception
     */
    public function updatePerson(PersonVO $personVO): ?Person
    {
        /** @var Person $personObject */
        $personObject = $this->entityManager->getRepository(Person::class)->find($personVO->id);

        if(empty($personObject)){
            throw new Exception('Pessoa não encontrada', 400);
        }

        $personObject->setName($personVO->name);
        $personObject->setDateOfBirth(new DateTime($personVO->dateOfBirth));

        $this->entityManager->persist($personObject);
        $this->entityManager->flush();

        return $personObject;
    }

    /**
     * @param int $id
     * @return object|null
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws Exception
     */
    public function deletePerson(int $id) {
        $personObject = $this->entityManager->getRepository(Person::class)->find($id);

        if(empty($personObject)) {
            throw new Exception('pessoa não encontrada', 400);
        }

        $this->entityManager->remove($personObject);
        $this->entityManager->flush();

        return $personObject;
    }

    /**
     * @return Person[]|array
     */
    public function findAllPerson(): array
    {
        return $this->entityManager->getRepository(Person::class)->findAll();
    }

    public function findPerson(int $id): ?Person
    {
        /** @var Person|null $personObject */
        $personObject = $this->entityManager->getRepository(Person::class)->find($id);
        return $personObject;
    }
}
