<?php
/**
 * Created by PhpStorm.
 * User: wsferreira
 * Date: 27/07/19
 * Time: 13:08
 */

namespace App\Presentation\Factory\Person;

use App\Handler\Person\DeletePersonHandler;
use Interop\Container\Exception\ContainerException;
use Slim\Container;

class DeletePersonFactoryHandler
{
    /**
     * @param Container $container
     * @return DeletePersonHandler
     * @throws ContainerException
     */
    public function __invoke(Container $container): DeletePersonHandler
    {
        $mediaService = $container->get(PersonFactoryService::class);
        return new DeletePersonHandler($mediaService);
    }
}
