<?php

namespace App\Factory\Media;

use App\Handler\Media\UpdateMediaHandler;
use App\Service\MediaService;
use Interop\Container\Exception\ContainerException;
use Slim\Container;

class UpdateMediaFactoryHandler
{
    /**
     * @param Container $container
     * @return UpdateMediaHandler
     * @throws ContainerException
     */
    public function __invoke(Container $container): UpdateMediaHandler
    {
        /** @var MediaService $mediaService */
        $mediaService = $container->get(MediaFactoryService::class);
        return new UpdateMediaHandler($mediaService);
    }
}
