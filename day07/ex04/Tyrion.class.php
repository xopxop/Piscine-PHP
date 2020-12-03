<?php

require_once 'Lannister.class.php';

class Tyrion extends Lannister {
	public function sleepWith($person) {
		if (get_class($person) === "Jaime" || get_class($person) === "Cersei")
			print("Not even if I'm drunk !" . PHP_EOL );
		else
			print("Let's do this." . PHP_EOL );
	}
}

?>