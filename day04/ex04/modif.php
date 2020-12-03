<?PHP

if ((isset($_POST['login'])) && ($_POST['login'] != "") && (isset($_POST['oldpw'])) && ($_POST['oldpw'] != "") && (isset($_POST['newpw'])) && ($_POST['newpw'] != "") && (isset($_POST['submit'])) && ($_POST['submit'] === "OK")) {
	$account = unserialize(file_get_contents("../private/passwd"));
	$match_but_no_modified = false;
	foreach ($account as $key => $elem)
		if ($elem['login'] === $_POST['login'])
		{
			if ($elem['passwd'] === hash("whirlpool", $_POST['oldpw']))
			{
				$account[$key]['passwd'] = hash("whirlpool", $_POST['newpw']);
				file_put_contents("../private/passwd", serialize($account));
				header('Location: index.html');
				echo "OK" . PHP_EOL;
				exit();
			}
			else
				echo "ERROR" . PHP_EOL;
			$match_but_no_modified = true;
			break ;
		}
		if ($match_but_no_modified == false)
			echo "ERROR" . PHP_EOL;
}
else
	echo "ERROR" . PHP_EOL;
?>