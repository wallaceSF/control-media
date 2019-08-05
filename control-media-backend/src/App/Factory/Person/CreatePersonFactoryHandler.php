<?php

namespace App\Factory\Person;

use App\Handler\Person\CreatePersonHandler;
use App\Service\PersonService;

use Interop\Container\Exception\ContainerException;
use Slim\Container;

class CreatePersonFactoryHandler
{
    /**
     * @param Container $container
     * @return CreatePersonHandler
     * @throws ContainerException
     */
    public function __invoke(Container $container): CreatePersonHandler
    {
        /** @var PersonService $personService */
        $personService = $container->get(PersonFactoryService::class);
        return new CreatePersonHandler($personService);
    }
}
