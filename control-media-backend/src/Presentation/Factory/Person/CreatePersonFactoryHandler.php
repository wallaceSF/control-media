<?php

namespace App\Presentation\Factory\Person;

use App\Domain\Contract\Application\PersonApplicationServiceInterface;
use App\Presentation\Handler\Person\CreatePersonHandler;
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
        $personService = $container->get(PersonApplicationServiceInterface::class);
        return new CreatePersonHandler($personService);
    }
}
