<?php

namespace Exec;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

error_reporting(E_ALL);
ini_set('display_errors', 'On');

include 'vendor/autoload.php';
$container = include 'services.php';

$entityManager = $container->get(EntityManager::class);
return ConsoleRunner::createHelperSet($entityManager);
