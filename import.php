<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

include 'vendor/autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = array("src/App/Entity");
$isDevMode = true;

// the connection configuration
if (isset($_SERVER['CLEARDB_DATABASE_URL'])) {
    $paths = parse_url($_SERVER['CLEARDB_DATABASE_URL']);
    $dbParams = [
        'driver'   => 'pdo_mysql',
        'user'     => $paths['user'],
        'password' => $paths['pass'],
        'host' => $paths['host'],
        'dbname'   => $paths['path'],
    ];
} else {
    $dbParams = array(
        'driver'   => 'pdo_mysql',
        'user'     => 'root',
        'password' => '',
        'dbname'   => 'foo',
    );
}


$config = Setup::createYAMLMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);
\Doctrine\DBAL\Types\Type::addType('uuid_binary_ordered_time', 'Ramsey\Uuid\Doctrine\UuidBinaryType');
$entityManager->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('uuid_binary_ordered_time', 'binary');

$history = new \Infrastructure\ETF\DoctrineHistory($entityManager);
$commandBus = new \Infrastructure\ETF\SimpleCommandBus();
$addToHistoryHandler = new \Domain\ETF\Command\AddToHistoryHandler($history);
$commandBus->registerHandler(\Domain\ETF\Command\AddToHistory::class, $addToHistoryHandler);
$importer = new \Domain\ETF\Importer($commandBus);

foreach(\Domain\ETF\AvailableETFs::list() as $code) {
    $importer->import($code, file('/Users/marcin/Downloads/data/daily/pl/wse etfs/'.strtolower($code).'.pl.txt'));
}