<?php

class NightsWatch implements IFighter {
	private $_recruit;

	public function recruit($person) {
		if ($person instanceof IFighter)
			$this->_recruit = $person->fight();
	}

	public function fight() {
		print $this->_recruit;
	}
}

?>