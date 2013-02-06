<?php

error_reporting(E_ALL ^ E_NOTICE);

define("APPLICATION_PATH", realpath(dirname(__FILE__) . "/../application"));
define("CORE_PATH", realpath(dirname(__FILE__) . "/../core"));


require_once CORE_PATH . "/Bootstrap.php";

$bootstrap = new Bootstrap();
$bootstrap->run();
