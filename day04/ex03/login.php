<?PHP
session_start();

include 'auth.php';
if ($_GET['login'] != NULL && $_GET['passwd'] != NULL)
{
	if (auth($_GET['login'], $_GET['passwd']) == true)
	{
		$_SESSION['loggued_on_user'] = $_GET['login'];
		echo "OK" . PHP_EOL;
	}
	else
		echo "ERROR" . PHP_EOL;
}
else
	echo "ERROR" . PHP_EOL;

?>