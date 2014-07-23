<?php

class Unitest {

	/**
	* When a suite is about to run
	*/
	final private function _runBeforeTests () {
		$arguments = func_get_args();
		$this->_execute('beforeTests', $arguments);
		return $this;
	}

}

?>