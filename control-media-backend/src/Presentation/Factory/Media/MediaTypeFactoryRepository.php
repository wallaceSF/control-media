<?php
/**
 * Created by PhpStorm.
 * User: wsferreira
 * Date: 27/07/19
 * Time: 18:13
 */

namespace App\Presentation\Factory\Media;

use App\Domain\Contract\Domain\DataBaseBuildInterface;
use App\Domain\Contract\Infrastruture\Repository\MediaTypeRepositoryInterface;
use App\Infrastructure\Repository\MediaTypeRepository;
use Interop\Container\Exception\ContainerException;
use Slim\Container;

class MediaTypeFactoryRepository
{
    /**
     * @param Container $container
     * @return MediaTypeRepositoryInterface
     * @throws ContainerException
     */
    public function __invoke(Container $container): MediaTypeRepositoryInterface
    {
        $mediaTypeRepository = $container->get(DataBaseBuildInterface::class);
        return new MediaTypeRepository($mediaTypeRepository);
    }
}
