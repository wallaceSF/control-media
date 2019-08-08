<?php

namespace App\Presentation\Factory\Person;

use App\Domain\Contract\Application\PersonApplicationServiceInterface;
use App\Presentation\Handler\Person\FindPersonHandler;
use App\Domain\Service\PersonService;
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
        $personService = $container->get(PersonApplicationServiceInterface::class);
        return new FindPersonHandler($personService);
    }
}
