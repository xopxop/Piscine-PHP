<?php

session_start();
if ($_GET['submit'] == "OK")
{
	$_SESSION['login'] = $_GET['login'];
	$_SESSION['passwd'] = $_GET['passwd'];
}

?>
<html><body>
<form action = "index.php" method = "GET">
	Username: <input type="text" name="login" value="<?PHP if (isset($_SESSION['login'])) { echo $_SESSION['login']; }; ?>" />
	<br />
	Password: <input type="password" name="passwd" value="<?PHP	if (isset($_SESSION['passwd']))	{ echo $_SESSION['passwd']; } ?>" />
	<input type="submit" name="submit" value="OK"/>
</form>
</body></html>
