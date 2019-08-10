<?php

namespace App\Presentation\Factory\MediaPersonLoan;

use App\Domain\Contract\Application\MediaPersonLoanApplicationServiceInterface;
use App\Presentation\Handler\MediaPersonLoan\CreateMediaPersonLoanHandler;
use Interop\Container\Exception\ContainerException;
use Slim\Container;

class CreateMediaPersonLoanFactoryHandler
{
    /**
     * @param Container $container
     * @return CreateMediaPersonLoanHandler
     * @throws ContainerException
     */
    public function __invoke(Container $container): CreateMediaPersonLoanHandler
    {
        $mediaService = $container->get(MediaPersonLoanApplicationServiceInterface::class);
        return new CreateMediaPersonLoanHandler($mediaService);
    }
}
