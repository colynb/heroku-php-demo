<?php

require '../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
	'monolog.logfile' => 'php://stderr',
));

// Register the Twig templating engine
$app->register(new Silex\Provider\TwigServiceProvider(), array(
	'twig.path' => __DIR__ . '/../views',
));

// Our web handlers

$app->get('/', function () use ($app) {
	$app['monolog']->addDebug('logging output.');
	$name = 'Colyn';
	return $app['twig']->render('index.html', compact('name'));
});

$app->run();

?>
