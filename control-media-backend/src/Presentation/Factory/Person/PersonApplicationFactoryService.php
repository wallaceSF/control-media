<?php
/**
 * Created by PhpStorm.
 * User: wsferreira
 * Date: 27/07/19
 * Time: 18:13
 */

namespace App\Presentation\Factory\Person;


use App\Application\Service\PersonApplicationService;
use App\Presentation\Factory\Person\PersonFactoryService;
use Slim\Container;

class PersonApplicationFactoryService
{
    public function __invoke(Container $container): PersonApplicationService
    {
        $r = $container->get(PersonFactoryService::class);
        return new PersonApplicationService($r);
    }
}
