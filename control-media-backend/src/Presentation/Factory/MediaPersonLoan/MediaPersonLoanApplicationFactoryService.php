<?php


namespace App\Presentation\Factory\MediaPersonLoan;


use App\Application\Service\MediaPersonLoanApplicationService;
use App\Domain\Contract\Domain\DataBaseBuildInterface;
use App\Domain\Service\MediaPersonLoanService;
use App\Presentation\Factory\Media\MediaFactoryService;
use Interop\Container\Exception\ContainerException;
use Slim\Container;

class MediaPersonLoanApplicationFactoryService
{
    /**
     * @param Container $container
     * @return MediaPersonLoanService
     * @throws ContainerException
     */
    public function __invoke(Container $container): MediaPersonLoanApplicationService
    {
        $entityManager = $container->get(MediaPersonLoanFactoryService::class);
        return new MediaPersonLoanApplicationService($entityManager);
    }

}