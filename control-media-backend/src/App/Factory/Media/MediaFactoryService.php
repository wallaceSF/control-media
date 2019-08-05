<?php
/**
 * Created by PhpStorm.
 * User: wsferreira
 * Date: 27/07/19
 * Time: 18:13
 */

namespace App\Factory\Media;

use App\Service\MediaService;
use Doctrine\ORM\EntityManager;
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
        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);
        return new MediaService($entityManager);
    }
}
