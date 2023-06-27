<?php

require_once "../autoload.php";
require_once "../vendor/framework/util.php";

use Config\Kernel;

session_start();

$kernel = new Kernel();
$kernel->run();

