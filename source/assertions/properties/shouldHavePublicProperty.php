<?php

class Unitest {

	/**
	* A property with the visibility "public" should exist in class or object.
	*/
	final protected function shouldHavePublicProperty ($objectOrClass, $property) {
		$arguments = func_get_args();
		array_shift($arguments);

		// Test all given properties
		foreach ($arguments as $argument) {
			if (!property_exists($objectOrClass, $argument)) {
				return $this->fail();
			} else if ($this->_propertyVisibility($objectOrClass, $argument) !== 'public') {
				return $this->fail();
			}
		}

		return $this->pass();
	}

}

?>