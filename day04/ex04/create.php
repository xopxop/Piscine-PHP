<?PHP

function creatAccount($account) {
	$newAccount['login'] = $_POST['login'];
	$newAccount['passwd'] = hash("whirlpool", $_POST['passwd']);
	$account[] = $newAccount;
	file_put_contents("../private/passwd", serialize($account));
}

if ($_POST['login'] && $_POST['login'] != "" && $_POST['passwd'] && $_POST['passwd'] != "" && $_POST['submit'] && $_POST['submit'] === "OK") {
	if (!file_exists("../private")) {
		mkdir("../private");
		chmod("../private", 0777);
	}
	if (!file_exists("../private/passwd")) {
		file_put_contents("../private/passwd", NULL);
		chmod("../private/passwd", 0777);
	}
	$account = unserialize(file_get_contents("../private/passwd"));
	$exist = false;
	if ($account) {
		foreach ($account as $elem)
			if ($elem['login'] == $_POST['login']) {
				$exist = true;
				break ;
			}
	}
	if ($exist == false) {
		creatAccount($account);
		header('Location: index.html');
		echo "OK\n";
	} else {
		echo "ERROR\n";
	}
}
else {
	echo "ERROR\n";
}
?>