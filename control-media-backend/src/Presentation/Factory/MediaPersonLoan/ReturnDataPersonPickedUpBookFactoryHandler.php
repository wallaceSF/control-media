<?php
/**
 * Created by PhpStorm.
 * User: wsferreira
 * Date: 27/07/19
 * Time: 18:13
 */

namespace App\Presentation\Factory\MediaPersonLoan;

use App\Domain\Contract\Application\MediaPersonLoanApplicationServiceInterface;
use App\Presentation\Handler\MediaPersonLoan\ReturnDataPersonPickedUpBookHandler;
use Interop\Container\Exception\ContainerException;
use Slim\Container;

class ReturnDataPersonPickedUpBookFactoryHandler
{
    /**
     * @param Container $container
     * @return ReturnDataPersonPickedUpBookHandler
     * @throws ContainerException
     */
    public function __invoke(Container $container): ReturnDataPersonPickedUpBookHandler
    {
        $mediaPersonLoanService = $container->get(MediaPersonLoanApplicationServiceInterface::class);
        return new ReturnDataPersonPickedUpBookHandler($mediaPersonLoanService);
    }
}
