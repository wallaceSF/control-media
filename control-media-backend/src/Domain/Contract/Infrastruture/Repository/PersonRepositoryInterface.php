<?php

namespace App\Domain\Contract\Infrastruture\Repository;

use App\Domain\Entity\Person;

interface PersonRepositoryInterface
{
    public function persist(Person $person);
    public function findAll();

    public function find(int $id): ?Person;
    public function remove(Person $person);
}