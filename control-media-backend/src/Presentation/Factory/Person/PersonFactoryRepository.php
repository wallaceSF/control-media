<?php
/**
 * Created by PhpStorm.
 * User: wsferreira
 * Date: 27/07/19
 * Time: 18:13
 */

namespace App\Presentation\Factory\Person;

use App\Domain\Contract\Domain\DataBaseBuildInterface;
use App\Domain\Contract\Infrastruture\Repository\PersonRepositoryInterface;
use App\Infrastructure\Repository\PersonRepository;
use Interop\Container\Exception\ContainerException;
use Slim\Container;


class PersonFactoryRepository
{
    /**
     * @param Container $container
     * @return PersonRepositoryInterface
     * @throws ContainerException
     */
    public function __invoke(Container $container): PersonRepositoryInterface
    {
        /** @var DataBaseBuildInterface $dataBaseBuild */
        $dataBaseBuild = $container->get(DataBaseBuildInterface::class);

        return new PersonRepository($dataBaseBuild);
    }
}
