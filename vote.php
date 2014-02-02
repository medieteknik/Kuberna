<?php
// we require login!
define('REQIRE_LOGIN', true);
// start system!
require_once('system.php');

// post or no post?
if(!isset($_POST['vote']) || !phpCAS::isAuthenticated())
	header('Location: ./');

// get post data
$gray = mysqli_real_escape_string($sysdb, $_POST['gray']);
$orange = mysqli_real_escape_string($sysdb, $_POST['orange']);
$liuid = mysqli_real_escape_string($sysdb, phpCAS::getUser());

// prepare query
$query = "INSERT INTO votes (gray, orange, liuid) VALUES('$gray', '$orange', '$liuid')";

// has the user voted before?
if(!has_voted(phpCAS::getUser(), $sysdb))
	// run query
	$sysdb->query($query);

// redir to index
header('Location: ./#black');
