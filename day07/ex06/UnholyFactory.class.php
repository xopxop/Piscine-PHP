<?php

class UnholyFactory {
	private $_absorbed = [];

	public function absorb($target) {
		if ($target instanceof Fighter) {
			if (array_key_exists($target->_type, $this->_absorbed)) {
				echo "(Factory already absorbed a fighter of type " . $target->_type . ")" . PHP_EOL;
			} else {
				$this->_absorbed[$target->_type] = $target;
				echo "(Factory absorbed a fighter of type " . $target->_type . ")" . PHP_EOL;
			}
		} else {
			echo "(Factory can't absorb this, it's not a fighter)" . PHP_EOL;
		}
	}

	public function fabricate($rf) {
		if (array_key_exists($rf, $this->_absorbed)) {
			echo "(Factory fabricates a fighter of type " . $rf . ")" . PHP_EOL;
			return $this->_absorbed[$rf];
		}
		echo "(Factory hasn't absorbed any fighter of type " . $rf . ")" . PHP_EOL;
		return NULL;
	}
}

?>