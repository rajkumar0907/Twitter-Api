<?php

/*
 * Include Autoloader
 * Autoloading as per PSR-4 standard
 */

require_once dirname(__FILE__).'/Autoloader.php';
require_once dirname(__FILE__).'/autoload_psr4.php';
require_once dirname(__FILE__).'/utils/helperFunction.php';


use \libs\Bootstrap;
use \libs\Rest;


/* Initiate the application */

$bootstrap = new Bootstrap();

 ?>
 