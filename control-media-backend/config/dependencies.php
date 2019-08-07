<?php

use App\Application\Service\MediaApplicationService;
use App\Domain\Contract\Application\MediaApplicationServiceInterface;
use App\Domain\Contract\Application\PersonApplicationServiceInterface;
use App\Domain\Contract\Domain\DataBaseBuildInterface;
use App\Domain\Contract\Infrastruture\Repository\MediaRepositoryInterface;
use App\Domain\Contract\Infrastruture\Repository\MediaTypeRepositoryInterface;
use App\Domain\Contract\Infrastruture\Repository\PersonRepositoryInterface;
use App\Domain\Service\DatabaseBuild;
use App\Presentation\Factory\Media\CreateMediaFactoryHandler;
use App\Presentation\Factory\Media\FindByMediaFactoryHandler;
use App\Presentation\Factory\Media\MediaApplicationFactoryService;
use App\Presentation\Factory\Media\MediaFactoryRepository;
use App\Presentation\Factory\Media\MediaTypeFactoryRepository;
use App\Presentation\Factory\Person\PersonApplicationFactoryService;
use App\Presentation\Factory\MediaPersonLoan\ReturnDataPersonPickedUpBookFactoryHandler;
use App\Presentation\Factory\Person\CreatePersonFactoryHandler;
use App\Presentation\Factory\Media\DeleteMediaFactoryHandler;
use App\Presentation\Factory\Person\DeletePersonFactoryHandler;
use App\Presentation\Factory\Media\FindAllMediaFactoryHandler;
use App\Presentation\Factory\Media\FindMediaFactoryHandler;
use App\Presentation\Factory\Media\MediaFactoryService;
use App\Presentation\Factory\Person\FindAllPersonFactoryHandler;
use App\Presentation\Factory\Person\PersonFactoryRepository;
use App\Presentation\Factory\Person\PersonFactoryService;
use App\Presentation\Factory\Media\UpdateMediaFactoryHandler;
use App\Presentation\Factory\Person\UpdatePersonFactoryHandler;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Slim\App;

/**
 * @param App $app
 */
return function (App $app) {
    $container = $app->getContainer();

    // view renderer
    $container['renderer'] = function ($c) {
        $settings = $c->get('settings')['renderer'];
        return new \Slim\Views\PhpRenderer($settings['template_path']);
    };

    // monolog
    $container['logger'] = function ($c) {
        $settings = $c->get('settings')['logger'];
        $logger = new \Monolog\Logger($settings['name']);
        $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
        $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
        return $logger;
    };


    //Handler
    $container[FindMediaFactoryHandler::class] = new FindMediaFactoryHandler();
    $container[FindByMediaFactoryHandler::class] = new FindByMediaFactoryHandler();

    $container[FindAllMediaFactoryHandler::class] = new FindAllMediaFactoryHandler();
    $container[CreateMediaFactoryHandler::class] = new CreateMediaFactoryHandler();
    $container[UpdateMediaFactoryHandler::class] = new UpdateMediaFactoryHandler();
    $container[DeleteMediaFactoryHandler::class] = new DeleteMediaFactoryHandler();

    $container[FindAllPersonFactoryHandler::class] = new FindAllPersonFactoryHandler();
    $container[CreatePersonFactoryHandler::class] = new CreatePersonFactoryHandler();
    $container[UpdatePersonFactoryHandler::class] = new UpdatePersonFactoryHandler();
    $container[DeletePersonFactoryHandler::class] = new DeletePersonFactoryHandler();

    $container[ReturnDataPersonPickedUpBookFactoryHandler::class] = new ReturnDataPersonPickedUpBookFactoryHandler();

    //Application
    $container[MediaApplicationServiceInterface::class] = new MediaApplicationFactoryService();
    $container[PersonApplicationServiceInterface::class] = new PersonApplicationFactoryService();


    //Service
    $container[MediaFactoryService::class] = new MediaFactoryService();
    $container[PersonFactoryService::class] = new PersonFactoryService();

    //Repository
    $container[MediaRepositoryInterface::class] = new MediaFactoryRepository();
    $container[MediaTypeRepositoryInterface::class] = new MediaTypeFactoryRepository();

    $container[PersonRepositoryInterface::class] = new PersonFactoryRepository();


    $container[DataBaseBuildInterface::class] = function ($container) {
        $config = Setup::createXMLMetadataConfiguration(
            [__DIR__ . '/../src/Infrastructure/Mapping'],
            true,
            null,
            null
        );

        $entityManager = EntityManager::create($container['settings']['doctrine']['connection'], $config);
        $r = new DataBaseBuild($entityManager);
        return $r;
    };

};
