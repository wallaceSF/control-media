<?php

namespace App\Factory\Media;

use App\Handler\Media\FindAllMediaHandler;
use App\Service\MediaService;
use Interop\Container\Exception\ContainerException;
use Slim\Container;

class FindAllMediaFactoryHandler
{
    /**
     * @param Container $container
     * @return FindAllMediaHandler
     * @throws ContainerException
     */
    public function __invoke(Container $container): FindAllMediaHandler
    {
        /** @var MediaService $mediaService */
        $mediaService = $container->get(MediaFactoryService::class);
        return new FindAllMediaHandler($mediaService);
    }
}
