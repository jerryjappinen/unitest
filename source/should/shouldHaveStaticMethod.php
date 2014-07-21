<?php

class Unitest {

	/**
	* A static method should exist in class.
	*/
	final public function shouldHaveStaticMethod ($testableClass, $method) {
		$arguments = func_get_args();
		array_shift($arguments);

		// Test all given methods
		foreach ($arguments as $argument) {
			if (!method_exists($testableClass, $argument)) {
				return $this->fail();
			} else {

				// Use reflection to check method
				$ref = new ReflectionMethod($testableClass, $argument);
				if (!$ref->isStatic()) {
					return $this->fail();
				}

			}
		}

		return $this->pass();
	}

}

?>