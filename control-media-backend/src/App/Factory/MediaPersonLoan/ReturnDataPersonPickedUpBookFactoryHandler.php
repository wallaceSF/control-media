<?php
/**
 * Created by PhpStorm.
 * User: wsferreira
 * Date: 27/07/19
 * Time: 18:13
 */

namespace App\Factory\MediaPersonLoan;

use App\Handler\Media\ReturnDataPersonPickedUpBookHandler;
use App\Service\MediaPersonLoanService;
use Doctrine\ORM\EntityManager;
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
        /** @var MediaPersonLoanService $mediaPersonLoanService */
        $mediaPersonLoanService = $container->get(MediaPersonLoanFactoryService::class);
        return new ReturnDataPersonPickedUpBookHandler($mediaPersonLoanService);
    }
}
