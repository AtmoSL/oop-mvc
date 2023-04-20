<?php

require '../vendor/Evd/Main/Loader.php';
require '../vendor/Evd/helpers.php';

use vendor\Evd\Main\Loader;

$loader = new Loader();

spl_autoload_register([$loader, 'load']);

require "../app/Routing/WebRouting.php";