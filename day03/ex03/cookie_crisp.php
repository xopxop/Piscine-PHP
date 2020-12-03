<?php

if (array_key_exists("action", $_GET)) {
	if ($_GET["action"] === "set") {
		setcookie($_GET["name"], $_GET["value"], time() + 3600);
	} else if ($_GET["action"] === "get") {
		if ($_GET["name"] && $_COOKIE[$_GET["name"]]) {
			echo $_COOKIE[$_GET["name"]]."\n";
		}
	}
	else if ($_GET["action"] === "del") {
		if ($_GET["name"]) {
			setcookie($_GET["name"], NULL, time() - 3600);
		}
	}
}

?>
