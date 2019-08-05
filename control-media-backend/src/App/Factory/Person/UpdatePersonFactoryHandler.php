<?php
/**
 * Created by PhpStorm.
 * User: wsferreira
 * Date: 27/07/19
 * Time: 13:08
 */

namespace App\Factory\Person;

use App\Handler\Person\UpdatePersonHandler;
use App\Service\PersonService;
use Interop\Container\Exception\ContainerException;
use Slim\Container;

class UpdatePersonFactoryHandler
{
    /**
     * @param Container $container
     * @return UpdatePersonHandler
     * @throws ContainerException
     */
    public function __invoke(Container $container): UpdatePersonHandler
    {
        /** @var PersonService $personService */
        $personService = $container->get(PersonFactoryService::class);
        return new UpdatePersonHandler($personService);
    }
}
