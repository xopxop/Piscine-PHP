<?php

if (isset($_POST['id']) && isset($_POST['value'])) {
	file_put_contents("list.cvs", $_POST['id'] . ";" . $_POST['value'] . PHP_EOL, FILE_APPEND);
}

?>