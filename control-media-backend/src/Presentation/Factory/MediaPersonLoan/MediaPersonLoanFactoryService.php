<?php
/**
 * Created by PhpStorm.
 * User: wsferreira
 * Date: 27/07/19
 * Time: 18:13
 */

namespace App\Presentation\Factory\MediaPersonLoan;

use App\Domain\Contract\Infrastruture\Repository\MediaPersonLoanRepositoryInterface;
use App\Domain\Contract\Infrastruture\Repository\MediaRepositoryInterface;
use App\Domain\Contract\Infrastruture\Repository\PersonRepositoryInterface;
use App\Domain\Service\MediaPersonLoanService;
use Interop\Container\Exception\ContainerException;
use Slim\Container;

class MediaPersonLoanFactoryService
{
    /**
     * @param Container $container
     * @return MediaPersonLoanService
     * @throws ContainerException
     */
    public function __invoke(Container $container): MediaPersonLoanService
    {
        /** @var MediaPersonLoanRepositoryInterface $mediaRepository */
        $mediaPersonLoanRepository = $container->get(MediaPersonLoanRepositoryInterface::class);
        /** @var MediaRepositoryInterface $mediaRepository */
        $mediaRepository = $container->get(MediaRepositoryInterface::class);
        /** @var PersonRepositoryInterface $personRepository */
        $personRepository = $container->get(PersonRepositoryInterface::class);
        return new MediaPersonLoanService($mediaPersonLoanRepository, $mediaRepository, $personRepository);
    }
}
