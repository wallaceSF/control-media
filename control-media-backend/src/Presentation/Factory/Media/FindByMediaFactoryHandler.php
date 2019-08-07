<?php

namespace App\Presentation\Factory\Media;

use App\Domain\Contract\Application\MediaApplicationServiceInterface;
use App\Presentation\Handler\Media\FindByMediaHandler;
use App\Domain\Service\MediaService;
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
        $mediaService = $container->get(MediaApplicationServiceInterface::class);
        return new FindByMediaHandler($mediaService);
    }
}
