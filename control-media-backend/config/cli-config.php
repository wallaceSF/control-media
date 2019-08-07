<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Setup;

require __DIR__ . '/../vendor/autoload.php';
$container = require 'settings.php';

$config = Setup::createXMLMetadataConfiguration(
    [__DIR__ . '/../src/App/Mapping'],
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

return ConsoleRunner::createHelperSet($entityManager);
