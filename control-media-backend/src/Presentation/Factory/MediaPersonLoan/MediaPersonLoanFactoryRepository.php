<?php
/**
 * Created by PhpStorm.
 * User: wsferreira
 * Date: 27/07/19
 * Time: 18:13
 */

namespace App\Presentation\Factory\MediaPersonLoan;

use App\Domain\Contract\Domain\DataBaseBuildInterface;
use App\Domain\Contract\Infrastruture\Repository\MediaPersonLoanRepositoryInterface;
use App\Infrastructure\Repository\MediaPersonLoanRepository;
use Slim\Container;

class MediaPersonLoanFactoryRepository
{
    public function __invoke(Container $container): MediaPersonLoanRepositoryInterface
    {
        $mediaTypeRepository = $container->get(DataBaseBuildInterface::class);
        return new MediaPersonLoanRepository($mediaTypeRepository);
    }
}
