<?PHP

if ($_POST['login'] && $_POST['login'] != "" && $_POST['oldpw'] && $_POST['oldpw'] != "" && $_POST['newpw'] && $_POST['newpw'] != "" && $_POST['submit'] && $_POST['submit'] === "OK") {
	$account = unserialize(file_get_contents("../private/passwd"));
	$match_but_no_modified = false;
	foreach ($account as $key => $elem)
		if ($elem['login'] === $_POST['login'])
		{
			if ($elem['passwd'] === hash("whirlpool", $_POST['oldpw']))
			{
				$account[$key]['passwd'] = hash("whirlpool", $_POST['newpw']);
				file_put_contents("../private/passwd", serialize($account));
				echo "OK" . PHP_EOL;
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