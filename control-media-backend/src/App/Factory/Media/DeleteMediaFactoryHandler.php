<?php

namespace App\Factory\Media;

use App\Handler\Media\DeleteMediaHandler;
use App\Service\MediaService;
use Interop\Container\Exception\ContainerException;
use Slim\Container;

class DeleteMediaFactoryHandler
{
    /**
     * @param Container $container
     * @return DeleteMediaHandler
     * @throws ContainerException
     */
    public function __invoke(Container $container): DeleteMediaHandler
    {
        /** @var MediaService $mediaService */
        $mediaService = $container->get(MediaFactoryService::class);
        return new DeleteMediaHandler($mediaService);
    }
}
