<?php
/**
 * Created by PhpStorm.
 * User: wsferreira
 * Date: 27/07/19
 * Time: 18:13
 */

namespace App\Presentation\Factory\Media;

use App\Domain\Contract\Domain\DataBaseBuildInterface;
use App\Infrastructure\Repository\MediaRepository;
use Interop\Container\Exception\ContainerException;
use Slim\Container;

class MediaFactoryRepository
{
    /**
     * @param Container $container
     * @return MediaRepository
     * @throws ContainerException
     */
    public function __invoke(Container $container): MediaRepository
    {
        /** @var DataBaseBuildInterface $entityManager */
        $entityManager = $container->get(DataBaseBuildInterface::class);
        return new MediaRepository($entityManager);
    }
}
