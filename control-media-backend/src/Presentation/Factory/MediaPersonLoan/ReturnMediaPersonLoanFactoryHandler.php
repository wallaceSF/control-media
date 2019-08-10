<?php

namespace App\Presentation\Factory\MediaPersonLoan;

use App\Domain\Contract\Application\MediaPersonLoanApplicationServiceInterface;
use App\Presentation\Handler\MediaPersonLoan\ReturnMediaPersonLoanHandler;
use Interop\Container\Exception\ContainerException;
use Slim\Container;

class ReturnMediaPersonLoanFactoryHandler
{
    /**
     * @param Container $container
     * @return ReturnMediaPersonLoanHandler
     * @throws ContainerException
     */
    public function __invoke(Container $container): ReturnMediaPersonLoanHandler
    {
        $mediaService = $container->get(MediaPersonLoanApplicationServiceInterface::class);
        return new ReturnMediaPersonLoanHandler($mediaService);
    }
}
