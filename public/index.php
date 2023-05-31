<?php

require __DIR__ . '/../vendor/autoload.php';

use Nicolasfoco\ApiTwitter\Controllers\TweetController;
use Nicolasfoco\ApiTwitter\Router;

$_ENV['ENVIRONMENT'] = parse_ini_file(__DIR__ . '/../environment.ini');

Router::add('/tweet', 'POST', TweetController::class, 'new');

Router::resolve($_SERVER['REDIRECT_URL']);
