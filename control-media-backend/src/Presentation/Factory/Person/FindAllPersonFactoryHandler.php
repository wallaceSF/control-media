<?php

namespace App\Presentation\Factory\Person;

use App\Presentation\Handler\Person\FindAllPersonHandler;
use App\Domain\Service\PersonService;
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
