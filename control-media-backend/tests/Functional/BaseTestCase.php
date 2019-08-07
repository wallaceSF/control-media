<?php

namespace Tests\Functional;

use App\Domain\Service\DatabaseBuild;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Environment;
use PHPUnit\Framework\TestCase;

/**
 * This is an example class that shows how you could set up a method that
 * runs the application. Note that it doesn't cover all use-cases and is
 * tuned to the specifics of this skeleton app, so if your needs are
 * different, you'll need to change it.
 */
class BaseTestCase extends TestCase
{
    /**
     * Use middleware when running application?
     *
     * @var bool
     */
    protected $withMiddleware = true;

    /**
     * Process the application given a request method and URI
     *
     * @param string $requestMethod the request method (e.g. GET, POST, etc.)
     * @param string $requestUri the request URI
     * @param array|object|null $requestData the request data
     * @return \Slim\Http\Response
     * @throws \Slim\Exception\MethodNotAllowedException
     * @throws \Slim\Exception\NotFoundException
     */
    public function runApp($requestMethod, $requestUri, $requestData = null)
    {
        // Create a mock environment for testing with
        $environment = Environment::mock(
            [
                'REQUEST_METHOD' => $requestMethod,
                'REQUEST_URI' => $requestUri
            ]
        );

        // Set up a request object based on the environment
        $request = Request::createFromEnvironment($environment);

        // Add request data, if it exists
        if (isset($requestData)) {
            $request = $request->withParsedBody($requestData);
        }

        // Set up a response object
        $response = new Response();

        // Use the application settings
        $settings = require __DIR__ . '/../../config/settings.php';

        // Instantiate the application
        $app = new App($settings);

        // Set up dependencies
        $dependencies = require __DIR__ . '/../../config/dependencies.php';

        $dependencies($app);

       // var_dump($app->getContainer(EntityManager::class));

        // Register middleware
        if ($this->withMiddleware) {
            $middleware = require __DIR__ . '/../../config/middleware.php';
            $middleware($app);
        }

        // Register routes
        $routes = require __DIR__ . '/../../config/routes.php';
        $routes($app);

        // Process the application
        $response = $app->process($request, $response);

        // Return the response
        return $response;
    }

    public function createEntityManager(){
        $container = require __DIR__.'/../../config/settings.php';

        $config = Setup::createXMLMetadataConfiguration(
            [__DIR__ . '/../../src/Infrastructure/Mapping'],
            true,
            null,
            null
        );

        try {
            $entityManager = EntityManager::create($container['settings']['doctrine']['connection'], $config);
        } catch (\Doctrine\ORM\ORMException $e) {
            var_dump($e);
            exit;
        }

        $r = new DataBaseBuild($entityManager);
        return $r;
    }
}
