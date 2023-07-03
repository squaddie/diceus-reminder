<?php

require_once 'vendor/autoload.php';

use Reminder\App\Controllers\ApplicationController;
use Reminder\App\Bootstrap\Container;

$app = (new Container())->get(ApplicationController::class);
$app->start();