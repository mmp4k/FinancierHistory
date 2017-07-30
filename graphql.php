<?php

namespace Exec;

use App\GraphQL\QueryBuilder;
use App\GraphQL\Type\Query;
use App\Query\DBAL\QueryHistoryView;
use App\Query\QueryHistory;
use ErrorException;
use GraphQL\Error\FormattedError;
use GraphQL\GraphQL;
use GraphQL\Schema;
use GraphQL\Type\Definition\Config;
use GraphQL\Utils\BuildSchema;

include 'vendor/autoload.php';
$container = include 'services.php';

$_GET['debug'] = true;
ini_set('display_errors', 0);
if (!empty($_GET['debug'])) {
    // Enable additional validation of type configs
    // (disabled by default because it is costly)
    Config::enableValidation();
    // Catch custom errors (to report them in query results if debugging is enabled)
    $phpErrors = [];
    set_error_handler(function($severity, $message, $file, $line) use (&$phpErrors) {
        $phpErrors[] = new ErrorException($message, 0, $severity, $file, $line);
    });
}
try {
    // Parse incoming query and variables
    if (isset($_SERVER['CONTENT_TYPE']) && strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false) {
        $raw = file_get_contents('php://input') ?: '';
        $data = json_decode($raw, true);
    } else {
        $data = $_REQUEST;
    }
    $data += ['query' => null, 'variables' => null];
    // GraphQL schema to be passed to query executor:
//    $schema = new Schema([
//        'query' => $container->get(QueryBuilder::class)->query()
//    ]);
    /** @var QueryHistory $queryHistoryView */
    $queryHistoryView = $container->get(QueryHistoryView::class);
    $root = [
        'hello' => function() {
            return 'asd';
        },
        'last' => function($root, $args) use($queryHistoryView) {
            $obj = $queryHistoryView->findLastAsset('ETFSP500');
            return $obj;
            return [
                'asset' => $obj->getAsset(),
                'highPrice' => 12,
            ];
        }
    ];
    $schema = BuildSchema::build(file_get_contents(__DIR__ . '/schema.graphqls'));
    $result = GraphQL::execute(
        $schema,
        $data['query'],
        $root,
        null,
        (array) $data['variables']
    );
    // Add reported PHP errors to result (if any)
    if (!empty($_GET['debug']) && !empty($phpErrors)) {
        $result['extensions']['phpErrors'] = array_map(
            ['GraphQL\Error\FormattedError', 'createFromPHPError'],
            $phpErrors
        );
    }
    $httpStatus = 200;
} catch (\Exception $error) {
    $httpStatus = 500;
    if (!empty($_GET['debug'])) {
        $result['extensions']['exception'] = FormattedError::createFromException($error);
    } else {
        $result['errors'] = [FormattedError::create('Unexpected Error')];
    }
}
header('Content-Type: application/json', true, $httpStatus);
echo json_encode($result);