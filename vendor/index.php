<?php
ini_set('display_errors','on');
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once  (dirname(__FILE__)."/../vendor/jfrp/Core.php");
jfrp\core::run();

?>
