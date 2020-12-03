<?PHP
session_start();

include 'auth.php';
if ($_POST['login'] && $_POST['passwd']) {
	if (auth($_POST['login'], $_POST['passwd']) == true) {
		$_SESSION['loggued_on_user'] = $_POST['login'];
		echo "<html>" . PHP_EOL;
		echo "	<body>" . PHP_EOL;
		echo "		<iframe name=\"chat\" src=\"chat.php\" width=\"100%\" height=\"550px\"></iframe>" . PHP_EOL;
		echo "		<iframe name=\"speak\" src=\"speak.php\" width=\"100%\" height=\"50px\"></iframe>" . PHP_EOL;
		echo "	</body>" . PHP_EOL;
		echo "</html>" . PHP_EOL;
	} else {
		echo "ERROR" . PHP_EOL;
	}
} else {
	echo "ERROR" . PHP_EOL;
}

?>
