<?php
declare(strict_types=1);

require __DIR__ . '/Infrastructure/Autoload/Autoloader.php';
\App\Infrastructure\Autoload\Autoloader::register('App\\', __DIR__ );

use App\Presentation\Controller\GameController;

$config = require __DIR__ . '/config/config.php';


$controller = new GameController($config);
$controller->handle();