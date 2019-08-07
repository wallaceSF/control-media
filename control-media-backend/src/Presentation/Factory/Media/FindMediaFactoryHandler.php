<?php

namespace App\Presentation\Factory\Media;

use App\Domain\Contract\Application\MediaApplicationServiceInterface;
use App\Presentation\Handler\Media\FindMediaHandler;
use App\Domain\Service\MediaService;
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
        $mediaService = $container->get(MediaApplicationServiceInterface::class);
        return new FindMediaHandler($mediaService);
    }
}
