<?php

namespace App\Domain\Contract\Domain;


use Doctrine\ORM\EntityManagerInterface;

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
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    public function getRepository(string $class);

    /**
     * @return EntityManagerInterface
     */
    public function getEntityManager();
}
