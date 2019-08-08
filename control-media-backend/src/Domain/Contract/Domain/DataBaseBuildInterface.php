<?php

namespace App\Domain\Contract\Domain;


use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

interface DataBaseBuildInterface
{
    public function beginTransaction();
    public function commit();
    public function rollback();
    public function insert($obj);
    public function update($obj);
    public function remove($obj);
    public function persist($obj);
    public function flush();

    /**
     * @param string $class
     * @return ObjectRepository|EntityRepository
     */
    public function getRepository(string $class);

    /**
     * @return EntityManagerInterface
     */
    public function getEntityManager();
}
