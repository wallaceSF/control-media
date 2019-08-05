<?php

namespace App\Factory\Media;

use App\Handler\Media\FindMediaHandler;
use App\Service\MediaService;
use Interop\Container\Exception\ContainerException;
use Slim\Container;

class FindMediaFactoryHandler
{
    /**
     * @param Container $container
     * @return FindMediaHandler
     * @throws ContainerException
     */
    public function __invoke(Container $container): FindMediaHandler
    {
        /** @var MediaService $mediaService */
        $mediaService = $container->get(MediaFactoryService::class);
        return new FindMediaHandler($mediaService);
    }
}
