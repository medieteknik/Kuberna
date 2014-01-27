<?php

/**
 * simple system startup
 */
error_reporting(E_ALL);
ini_set("display_errors", "On");

// connect to database
require_once 'database/connect.php';

// get nice functions
require_once 'functions.php';

// start cas authentication if login is requierd
if(defined('REQIRE_LOGIN') && REQIRE_LOGIN)
	require_once 'cas_start.php';
