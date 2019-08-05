<?php

namespace App\Factory\Person;

use App\Handler\Person\FindPersonHandler;
use App\Service\PersonService;
use Interop\Container\Exception\ContainerException;
use Slim\Container;

class FindPersonFactoryHandler
{
    /**
     * @param Container $container
     * @return FindPersonHandler
     * @throws ContainerException
     */
    public function __invoke(Container $container): FindPersonHandler
    {
        /** @var PersonService $mediaService */
        $mediaService = $container->get(PersonFactoryService::class);
        return new FindPersonHandler($mediaService);
    }
}
