<?PHP

session_start();
if ($_SESSION['loggued_on_user'] == NULL)
	echo "ERROR" . PHP_EOL;
else {
	if (file_exists("../private") && file_exists("../private/chat")) {
		$chat = unserialize(file_get_contents("../private/chat"));
		foreach ($chat as $info)
			echo "[" . date("H:i", $info['time']) . "] <b>" . $info['login'] . "</b>: " . $info['msg'] . "<br />" . PHP_EOL;
	}
}

?>