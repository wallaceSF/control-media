<?php

namespace App\Factory\Media;

use App\Handler\Media\CreateMediaHandler;
use App\Service\MediaService;
use Interop\Container\Exception\ContainerException;
use Slim\Container;

class CreateMediaFactoryHandler
{
    /**
     * @param Container $container
     * @return CreateMediaHandler
     * @throws ContainerException
     */
    public function __invoke(Container $container): CreateMediaHandler
    {
        /** @var MediaService $mediaService */
        $mediaService = $container->get(MediaFactoryService::class);
        return new CreateMediaHandler($mediaService);
    }
}