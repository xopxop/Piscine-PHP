<?php

class Fighter {
	private $_type;
	public function __construct($type) {
		$this->_type = $type;
	}
	public function __get($attribute) {
		if ($attribute == '_type') {
			return $this->_type;
		}
	}
}

?>