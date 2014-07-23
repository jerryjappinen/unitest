<?php

class Unitest {

	/**
	* An unoverridable method should exist in class or object.
	*/
	final protected function shouldHaveFinalMethod ($testableObjectOrClass, $method) {
		$arguments = func_get_args();
		array_shift($arguments);

		// Test all given methods
		foreach ($arguments as $argument) {
			if (!method_exists($testableObjectOrClass, $argument)) {
				return $this->fail();
			} else {

				// Use reflection to check method
				$ref = new ReflectionMethod($testableObjectOrClass, $argument);
				if (!$ref->isFinal()) {
					return $this->fail();
				}

			}
		}

		return $this->pass();
	}

}

?>