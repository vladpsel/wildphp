<?php

// 1. General settings
declare(strict_types=1);

use Voopsc\Wild\Core\Kernel;

ini_set('display_errors', '1');
error_reporting(E_ALL);

// 2. Constants and global vars
define('ROOT', dirname(__DIR__));
const APP_PUBLIC = __DIR__;

// 3. Autoload & Presets
include_once ROOT . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

/**
 * If you need to work with sessions,
 * you can initialize if here
 */
// session_start();

/**
 * 4. Additional methods
 * If you need to execute some methods, or do some other stuff
 * before initialize application, you can do it here
 */
// ini_set('date.timezone', 'Europe/Kiev');


// 5. Initialize application
$app = new Kernel();
$app->run();