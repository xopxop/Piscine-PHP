<?php

$file_content = file_get_contents("list.cvs");
$toDoList = explode("\n", $file_content);
echo json_encode($toDoList);

?>