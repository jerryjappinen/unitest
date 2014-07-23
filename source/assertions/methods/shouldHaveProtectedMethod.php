<?php

class Unitest {

	/**
	* A method with the visibility "protected" should exist in class or object.
	*/
	final protected function shouldHaveProtectedMethod ($objectOrClass, $method) {
		$arguments = func_get_args();
		array_shift($arguments);

		// Test all given methods
		foreach ($arguments as $argument) {
			if (!method_exists($objectOrClass, $argument)) {
				return $this->fail();
			} else if ($this->_methodVisibility($objectOrClass, $argument) !== 'protected') {
				return $this->fail();
			}
		}

		return $this->pass();
	}

}

?>