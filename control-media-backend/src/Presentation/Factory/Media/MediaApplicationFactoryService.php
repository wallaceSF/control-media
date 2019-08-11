<?php
/**
 * Created by PhpStorm.
 * User: wsferreira
 * Date: 27/07/19
 * Time: 18:13
 */

namespace App\Presentation\Factory\Media;

use App\Application\Service\MediaApplicationService;
use App\Domain\Contract\Application\ConnectionApplicationInterface;
use Slim\Container;

class MediaApplicationFactoryService
{
    public function __invoke(Container $container): MediaApplicationService
    {
        $mediaService = $container->get(MediaFactoryService::class);
        $connectionApplication = $container->get(ConnectionApplicationInterface::class);
        return new MediaApplicationService($mediaService, $connectionApplication);
    }
}
