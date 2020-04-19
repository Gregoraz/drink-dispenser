<?php declare(strict_types=1);

$loader = require 'vendor/autoload.php';
$loader->add('Drinks\\', __DIR__.'/src/');

$board = new App\Board\Board();
$board->main();