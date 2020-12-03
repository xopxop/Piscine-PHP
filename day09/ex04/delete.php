<?php

if (isset($_GET['key'])) {
	$file_content = file_get_contents("list.cvs");
	$pattern = "/" . $_GET['key'] . ';.*\n/';
	$file_content = preg_replace($pattern, "", $file_content);
	file_put_contents("list.cvs", $file_content);
}

?>