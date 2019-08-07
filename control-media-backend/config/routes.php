<?php

use App\Presentation\Factory\Media\CreateMediaFactoryHandler;
use App\Presentation\Factory\Person\CreatePersonFactoryHandler;
use App\Presentation\Factory\Media\DeleteMediaFactoryHandler;
use App\Presentation\Factory\Person\DeletePersonFactoryHandler;
use App\Presentation\Factory\Media\FindAllMediaFactoryHandler;
use App\Presentation\Factory\Person\FindAllPersonFactoryHandler;
use App\Presentation\Factory\Media\FindByMediaFactoryHandler;
use App\Presentation\Factory\Media\FindMediaFactoryHandler;
use App\Presentation\Factory\Person\FindPersonFactoryHandler;
use App\Presentation\Factory\Media\UpdateMediaFactoryHandler;
use App\Presentation\Factory\Person\UpdatePersonFactoryHandler;
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/[{name}]', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");

        // Render index view
        return $container->get('renderer')->render($response, 'index.phtml', $args);
    });

    $app->get("/media/", FindAllMediaFactoryHandler::class);
    $app->get("/media/{id}", FindMediaFactoryHandler::class);
    $app->post("/media/create/", CreateMediaFactoryHandler::class);
    $app->put("/media/update/", UpdateMediaFactoryHandler::class);
    $app->delete("/media/{id}", DeleteMediaFactoryHandler::class);
    $app->get("/media/find-by/{firstResult}/{maxResult}/{columnOrder}/{order}/", FindByMediaFactoryHandler::class);

    $app->get("/person/", FindAllPersonFactoryHandler::class);
    $app->get("/person/{id}", FindPersonFactoryHandler::class);
    $app->post("/person/create/", CreatePersonFactoryHandler::class);
    $app->put("/person/update/", UpdatePersonFactoryHandler::class);
    $app->delete("/person/{id}", DeletePersonFactoryHandler::class);
};
