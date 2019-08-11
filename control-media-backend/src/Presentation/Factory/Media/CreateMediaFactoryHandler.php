<?php

namespace App\Presentation\Factory\Media;

use App\Domain\Contract\Application\MediaApplicationServiceInterface;
use App\Presentation\Handler\Media\CreateMediaHandler;
use App\Domain\Service\MediaService;
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
        $mediaService = $container->get(MediaApplicationServiceInterface::class);
        return new CreateMediaHandler($mediaService);
    }
}
