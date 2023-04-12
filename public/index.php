<?php

require '../vendor/Evd/Main/Loader.php';

use vendor\Evd\Main\Loader;

$loader = new Loader();

spl_autoload_register([$loader, 'load']);