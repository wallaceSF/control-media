<?php

namespace App\Presentation\Factory\Media;

use App\Domain\Contract\Application\MediaApplicationServiceInterface;
use App\Presentation\Handler\Media\UpdateMediaHandler;
use App\Domain\Service\MediaService;
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
        $mediaService = $container->get(MediaApplicationServiceInterface::class);
        return new UpdateMediaHandler($mediaService);
    }
}
