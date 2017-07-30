<?php


namespace Exec;

use Domain\ETF\AvailableETFs;
use Domain\ETF\Importer;

error_reporting(E_ALL);
ini_set('display_errors', 'On');

include 'vendor/autoload.php';
$container = include 'services.php';

/** @var Importer $importer */
$importer = $container->get(Importer::class);

foreach (AvailableETFs::list() as $code) {
    $importer->import($code, file('/Users/marcin/Downloads/data/daily/pl/wse etfs/' . strtolower($code) . '.pl.txt'));
}