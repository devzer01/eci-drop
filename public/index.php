<?php

define('APP_PATH', dirname(__DIR__));

require APP_PATH . '/vendor/autoload.php';

// load configuration
$dotenv = new \Dotenv\Dotenv(APP_PATH);
$dotenv->load();
$dotenv->required(['APP_DEBUG']);

// define the app
$app = new \SlimController\Slim();

// configure application
$app->config([
    'templates.path' => APP_PATH . '/app/views',
    'controller.class_prefix' => '\\app\\controllers',
    'controller.class_suffix' => 'Controller',
    'controller.method_suffix' => 'Action',
    'view' => new \Slim\Views\Twig(),
    'log.enabled' => true,
    'log.level' => \Slim\Log::DEBUG,
    'log.writer' => new \Slim\Logger\DateTimeFileWriter([
        'path' => APP_PATH . '/storage/logs',
    ]),
]);

// configure models
require_once APP_PATH . '/vendor/j4mie/idiorm/idiorm.php';
require_once APP_PATH . '/vendor/j4mie/paris/paris.php';

ORM::configure('mysql:host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_NAME'));
ORM::configure('username', getenv('DB_USERNAME'));
ORM::configure('password', getenv('DB_PASSWORD'));

Model::$auto_prefix_models = '\\app\\models\\';

// configure views
$app->view()->parserOptions = [
    'debug' => true,
    'cache' => APP_PATH . '/storage/twig'
];
$app->view()->parserExtensions = [
    new \Slim\Views\TwigExtension(),
    new \src\twig\TwigExtension(),
];

// environment depending settings
if (getenv('APP_DEBUG') == 'true') {
    // configure logging
    $app->config('debug', true);

    // configure request logging
    $app->hook('slim.after.router', function () use ($app) {
        $request = $app->request;
        $response = $app->response;

        $app->log->debug(
            sprintf('Request path: %s - Response status: %d', $request->getPathInfo(), $response->getStatus())
        );
    });

    // configure error reporting
    $app->add(new \Zeuxisoo\Whoops\Provider\Slim\WhoopsMiddleware);

    // configure model logging
    ORM::configure('logging', true);

    ORM::configure('logger', function ($log_string, $query_time) use ($app) {
        $app->getLog()->debug(
            'Query [' . $log_string . '] time: [' . $query_time . ' seconds]'
        );
    });
} else {
    $app->config('debug', false);
}

// load routes
require_once APP_PATH . '/app/routes.php';

// run the app
$app->run();
