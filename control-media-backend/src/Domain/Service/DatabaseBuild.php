<?php

namespace App\Domain\Service;

use App\Domain\Contract\Domain\DataBaseBuildInterface;
use Doctrine\ORM\EntityManagerInterface;

class DatabaseBuild implements DataBaseBuildInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $repository;

    public function __construct(EntityManagerInterface $repository)
    {
        $this->repository = $repository;
    }

    public function beginTransaction()
    {
        $this->repository->beginTransaction();
    }

    public function commit()
    {
        $this->repository->commit();
    }

    public function rollback()
    {
        $this->repository->rollback();
    }

    /**
     * @param $obj
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function insert($obj)
    {
        $this->repository->persist($obj);
    }
    /**
     * @param $obj
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update($obj)
    {
        $this->repository->persist($obj);
    }
    /**
     * @param $obj
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove($obj)
    {
        $this->repository->remove($obj);
    }

    /**
     * @param $obj
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function persist($obj)
    {
        $this->repository->persist($obj);
    }

    public function flush()
    {
        $this->repository->flush();
    }

    /**
     * @param string $class
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    public function getRepository($class)
    {
        return $this->repository->getRepository($class);
    }

    /**
     * @return EntityManagerInterface
     */
    public function getEntityManager()
    {
        return $this->repository;
    }
}
