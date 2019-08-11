<?php
/**
 * Created by PhpStorm.
 * User: wsferreira
 * Date: 27/07/19
 * Time: 13:08
 */

namespace App\Presentation\Factory\Person;

use App\Handler\Person\UpdatePersonHandler;
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
        $personService = $container->get(PersonFactoryService::class);
        return new UpdatePersonHandler($personService);
    }
}
