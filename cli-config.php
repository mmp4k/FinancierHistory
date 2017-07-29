<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;

error_reporting(E_ALL);
ini_set('display_errors', 'On');

include 'vendor/autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = array("src/App/Entity");
$isDevMode = true;

// the connection configuration
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

return ConsoleRunner::createHelperSet($entityManager);
