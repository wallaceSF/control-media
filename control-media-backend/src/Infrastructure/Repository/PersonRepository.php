<?php

namespace App\Infrastructure\Repository;

use App\Domain\Contract\Domain\DataBaseBuildInterface;
use App\Domain\Contract\Infrastruture\Repository\PersonRepositoryInterface;
use App\Domain\Entity\Person;

class PersonRepository implements PersonRepositoryInterface
{
    /**
     * @var DataBaseBuildInterface
     */
    private $dataBaseBuildInterface;

    /**
     * PersonRepository constructor.
     * @param DataBaseBuildInterface $dataBaseBuildInterface
     */
    public function __construct(DataBaseBuildInterface $dataBaseBuildInterface)
    {
        $this->dataBaseBuildInterface = $dataBaseBuildInterface;
    }

    public function findAll(): array
    {
        return $this->dataBaseBuildInterface->getRepository(Person::class)->findAll();
    }

    public function find(int $id): ?Person
    {
        /** @var Person $mediaObject */
        $mediaObject = $this->dataBaseBuildInterface->getRepository(Person::class)->find($id);
        return $mediaObject;
    }

    public function remove(Person $media): Person
    {
        $this->dataBaseBuildInterface->remove($media);
        $this->dataBaseBuildInterface->flush();

        return $media;
    }

    public function persist(Person $media): Person
    {
        $this->dataBaseBuildInterface->persist($media);
        $this->dataBaseBuildInterface->flush();

        return $media;
    }
}