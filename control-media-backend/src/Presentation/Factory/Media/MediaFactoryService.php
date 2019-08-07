<?php
/**
 * Created by PhpStorm.
 * User: wsferreira
 * Date: 27/07/19
 * Time: 18:13
 */

namespace App\Presentation\Factory\Media;

use App\Domain\Contract\Infrastruture\Repository\MediaRepositoryInterface;
use App\Domain\Contract\Infrastruture\Repository\MediaTypeRepositoryInterface;
use App\Domain\Service\MediaService;
use Interop\Container\Exception\ContainerException;
use Slim\Container;

class MediaFactoryService
{
    /**
     * @param Container $container
     * @return MediaService
     * @throws ContainerException
     */
    public function __invoke(Container $container): MediaService
    {
        /** @var MediaRepositoryInterface $mediaRepository */
        $mediaRepository = $container->get(MediaRepositoryInterface::class);

        /** @var MediaTypeRepositoryInterface $mediaTypeRepository */
        $mediaTypeRepository = $container->get(MediaTypeRepositoryInterface::class);
        return new MediaService($mediaRepository, $mediaTypeRepository);
    }
}
