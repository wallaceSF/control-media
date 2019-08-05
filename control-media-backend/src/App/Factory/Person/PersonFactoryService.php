<?php
/**
 * Created by PhpStorm.
 * User: wsferreira
 * Date: 27/07/19
 * Time: 18:13
 */

namespace App\Factory\Person;

use App\Service\PersonService;
use Doctrine\ORM\EntityManager;
use Interop\Container\Exception\ContainerException;
use Slim\Container;

class PersonFactoryService
{
    /**
     * @param Container $container
     * @return PersonService
     * @throws ContainerException
     */
    public function __invoke(Container $container): PersonService
    {
        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);
        return new PersonService($entityManager);
    }
}
