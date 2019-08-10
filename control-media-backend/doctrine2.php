#!/usr/bin/env php
<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Symfony\Component\Console\Helper\HelperSet;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

require_once __DIR__ . '/vendor/autoload.php';
$container = require 'config/settings.php';

$config = Setup::createXMLMetadataConfiguration(
    [__DIR__ . '/src/Infrastructure/Mapping'],
    true,
    null,
    null
);

try {
    $defaultEntityManager1 = EntityManager::create($container['settings']['doctrine']['connection_unit_test'], $config);
} catch (\Doctrine\ORM\ORMException $e) {
    var_dump($e);
    exit;
}

//var_dump($defaultEntityManager); die;

$commands = [];

$helper2 = new Symfony\Component\Console\Helper\HelperSet([
    'db'            => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($defaultEntityManager1->getConnection()),
    'em'            => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($defaultEntityManager1),
]);


ConsoleRunner::run($helper2, $commands);
