<?php

require '../vendor/Evd/Main/Loader.php';
require '../vendor/Evd/helpers.php';

use vendor\Evd\Main\Loader;

session_start();

$loader = new Loader();

spl_autoload_register([$loader, 'load']);

require "../app/Routing/WebRouting.php";