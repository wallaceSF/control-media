<?php

namespace App\Factory\Person;

use App\Handler\Person\FindAllPersonHandler;
use App\Service\PersonService;
use Interop\Container\Exception\ContainerException;
use Slim\Container;

class FindAllPersonFactoryHandler
{
    /**
     * @param Container $container
     * @return FindAllPersonHandler
     * @throws ContainerException
     */
    public function __invoke(Container $container): FindAllPersonHandler
    {
        /** @var PersonService $personService */
        $personService = $container->get(PersonFactoryService::class);
        return new FindAllPersonHandler($personService);
    }
}
