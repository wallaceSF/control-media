<?php


namespace App\Presentation\Factory\MediaPersonLoan;

use App\Application\Service\MediaPersonLoanApplicationService;
use App\Domain\Service\MediaPersonLoanService;
use Interop\Container\Exception\ContainerException;
use Slim\Container;

class MediaPersonLoanApplicationFactoryService
{
    /**
     * @param Container $container
     * @return MediaPersonLoanApplicationService
     * @throws ContainerException
     */
    public function __invoke(Container $container): MediaPersonLoanApplicationService
    {
        $entityManager = $container->get(MediaPersonLoanFactoryService::class);
        return new MediaPersonLoanApplicationService($entityManager);
    }

}