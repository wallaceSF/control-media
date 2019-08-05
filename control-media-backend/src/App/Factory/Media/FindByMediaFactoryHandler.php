<?php

namespace App\Factory\Media;

use App\Handler\Media\FindByMediaHandler;
use App\Service\MediaService;
use Interop\Container\Exception\ContainerException;
use Slim\Container;

class FindByMediaFactoryHandler
{
    /**
     * @param Container $container
     * @return FindByMediaHandler
     * @throws ContainerException
     */
    public function __invoke(Container $container): FindByMediaHandler
    {
        /** @var MediaService $mediaService */
        $mediaService = $container->get(MediaFactoryService::class);
        return new FindByMediaHandler($mediaService);
    }
}
