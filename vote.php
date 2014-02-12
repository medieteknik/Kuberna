<?php
// avoid direct call to this file
if(!defined('REQUIRE_LOGIN')) header('Location: ./');

// post or no post? logged in? voted before?
if(isset($_POST['vote']) && phpCAS::isAuthenticated() && !has_voted(phpCAS::getUser(), $sysdb))
{
	// get post data
	$gray = mysqli_real_escape_string($sysdb, $_POST['gray']);
	$orange = mysqli_real_escape_string($sysdb, $_POST['orange']);
	$liuid = mysqli_real_escape_string($sysdb, phpCAS::getUser());

	// prepare query
	$query = "INSERT INTO votes (gray, orange, liuid) VALUES('$gray', '$orange', '$liuid')";

	// run query
	if($sysdb->query($query))
		header('Location: ./?thanks#black');
	else
		header('Location: ./?error#black');
}
