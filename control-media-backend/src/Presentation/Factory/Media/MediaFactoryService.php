<?php
/**
 * Created by PhpStorm.
 * User: wsferreira
 * Date: 27/07/19
 * Time: 18:13
 */

namespace App\Presentation\Factory\Media;

use App\Domain\Contract\Infrastruture\Repository\MediaPersonLoanRepositoryInterface;
use App\Domain\Contract\Infrastruture\Repository\MediaRepositoryInterface;
use App\Domain\Contract\Infrastruture\Repository\MediaTypeRepositoryInterface;
use App\Domain\Service\MediaPersonLoanService;
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
        //criar interfaces para service
        /** @var MediaRepositoryInterface $mediaRepository */
        $mediaRepository = $container->get(MediaRepositoryInterface::class);

        /** @var MediaTypeRepositoryInterface $mediaTypeRepository */
        $mediaTypeRepository = $container->get(MediaTypeRepositoryInterface::class);

        /** @var MediaPersonLoanService $mediaPersonLoanService */
        $mediaPersonLoanService = $container->get(MediaPersonLoanService::class);
        return new MediaService($mediaRepository, $mediaTypeRepository, $mediaPersonLoanService);
    }
}
