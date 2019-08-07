<?php
/**
 * Created by PhpStorm.
 * User: wsferreira
 * Date: 27/07/19
 * Time: 18:13
 */

namespace App\Presentation\Factory\Person;

use App\Domain\Contract\Infrastruture\Repository\MediaRepositoryInterface;
use App\Domain\Contract\Infrastruture\Repository\PersonRepositoryInterface;
use App\Domain\Service\PersonService;
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
    public function __invoke(Container $container)
    {

        $personRepository = $container->get(PersonRepositoryInterface::class);

       // var_dump($personRepository);; die;

        return new PersonService($personRepository);
    }
}
