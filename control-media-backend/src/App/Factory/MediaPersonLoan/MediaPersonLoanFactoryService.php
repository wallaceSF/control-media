<?php
/**
 * Created by PhpStorm.
 * User: wsferreira
 * Date: 27/07/19
 * Time: 18:13
 */

namespace App\Factory\MediaPersonLoan;

use App\Service\MediaPersonLoanService;
use Doctrine\ORM\EntityManager;
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
        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);
        return new MediaPersonLoanService($entityManager);
    }
}
