<?php
/**
 * Created by PhpStorm.
 * User: wsferreira
 * Date: 27/07/19
 * Time: 18:13
 */

namespace App\Presentation\Factory\Person;

use App\Application\Service\PersonApplicationService;
use App\Domain\Contract\Application\ConnectionApplicationInterface;
use Slim\Container;

class PersonApplicationFactoryService
{
    public function __invoke(Container $container): PersonApplicationService
    {
        $personService = $container->get(PersonFactoryService::class);
        $connectionApplication = $container->get(ConnectionApplicationInterface::class);
        return new PersonApplicationService($personService, $connectionApplication);
    }
}
