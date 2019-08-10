<?php

namespace App\Presentation\Factory\Media;

use App\Application\Service\MediaApplicationService;

use App\Domain\Contract\Application\MediaApplicationServiceInterface;
use App\Presentation\Handler\Media\FindAllMediaHandler;
use App\Domain\Service\MediaService;
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
        $mediaService = $container->get(MediaApplicationServiceInterface::class);

        return new FindAllMediaHandler($mediaService);
    }
}
