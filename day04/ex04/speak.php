<?PHP
session_start();
if ($_SESSION['loggued_on_user'] == NULL) {
	echo "ERROR" . PHP_EOL;
} else if ($_POST['msg']) {
		if (!file_exists("../private")) {
			mkdir("../private");
			chmod("../private", 0777);
		}
		if (!file_exists("../private/chat")) {
			file_put_contents("../private/chat", NULL);
			chmod("../private/chat", 0777);
		}
		$chat = unserialize(file_get_contents("../private/chat"));
		$fd = fopen("../private/chat", 'w');
		flock($fd, LOCK_EX);
		$data['time'] = time();
		$data['login'] = $_SESSION['loggued_on_user'];
		$data['msg'] = $_POST['msg'];
		$chat[] = $data;
		file_put_contents("../private/chat", serialize($chat));
		fclose($fd);
		?>
<!DOCTYPE html>
<html>
	<body>
		<form action="speak.php" method="POST">
			Message: <input type="text" name="msg" value="" />
			<br />
			<input type="submit" name="submit" value="OK" />
		</form>
	</body>
</html>
<?php } ?>