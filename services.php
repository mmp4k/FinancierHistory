<?php

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Symfony\Component\DependencyInjection\ContainerBuilder;

include "vendor/autoload.php";

$paths = array("src/App/Entity");
$isDevMode = true;

// the connection configuration
$dbParams = array(
    'driver' => 'pdo_mysql',
    'user' => 'root',
    'password' => '',
    'dbname' => 'foo',
);

$config = Setup::createYAMLMetadataConfiguration($paths, $isDevMode);

$container = new ContainerBuilder();
$container->register(\Doctrine\ORM\EntityManager::class)
    ->addArgument($dbParams)
    ->addArgument($config)
    ->setFactory([EntityManager::class, 'create']);
$entityManager = $container->get(EntityManager::class);


$container->autowire(\Infrastructure\ETF\DoctrineHistory::class);
$container->autowire(\Domain\ETF\Command\AddToHistoryHandler::class);
$container->autowire(\Infrastructure\ETF\SimpleCommandBus::class)
    ->addMethodCall('registerHandler', [\Domain\ETF\Command\AddToHistory::class, new \Symfony\Component\DependencyInjection\Reference(\Domain\ETF\Command\AddToHistoryHandler::class)]);
$container->autowire(\Domain\ETF\Importer::class);
$container->autowire(\App\GraphQL\QueryBuilder::class);
$container->autowire(\App\Query\DBAL\QueryHistoryView::class);
$container->compile();


Type::addType('uuid_binary_ordered_time', 'Ramsey\Uuid\Doctrine\UuidBinaryType');
$entityManager->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('uuid_binary_ordered_time', 'binary');


return $container;