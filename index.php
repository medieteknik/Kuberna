<?php
// we require login!
define('REQIRE_LOGIN', true);

require_once 'system.php';
?>

<html>
  <head>
    <title>Vote!</title>
  </head>
  <body>
    <h1>Successfull Authentication!</h1>
    <?php
    	if(!phpCAS::isAuthenticated())
    	{
    		echo '<p>Not logged in! No vote.</p>';
    	}
    	else
    	{
    		echo '<p>the user\'s login is <strong>' . phpCAS::getUser() . '</strong>. Vote!</p>';
    	}
    ?>
    <p>
    	<a href="?<?php echo phpCAS::isAuthenticated() ? 'logout' : 'login'; ?>">
    		<?php echo phpCAS::isAuthenticated() ? 'logout' : 'login'; ?>
    	</a>
    </p>
  </body>
</html>
