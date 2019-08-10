<?php

namespace App\Presentation\Factory\Media;

use App\Domain\Contract\Application\MediaApplicationServiceInterface;
use App\Presentation\Handler\Media\DeleteMediaHandler;
use App\Domain\Service\MediaService;
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
        $mediaService = $container->get(MediaApplicationServiceInterface::class);
        return new DeleteMediaHandler($mediaService);
    }
}
