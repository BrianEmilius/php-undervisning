<?php

class Animal {

	public function __construct($name) {
		$this->name = $name;
	}

	public function makeANoise() {
		echo $this->name . ' makes a noise.';
	}

}

class Dog extends Animal {
	public function makeANoise() {
		echo $this->name . ' barks.';
	}
}

class Cat extends Animal {
	public function makeANoise() {
		echo $this->name . ' miavs.';
	}
}

$animal = new Animal('Bertie');
$animal->makeANoise();
$dog = new Dog('Fido');
$dog->makeANoise();
$cat = new Cat('Bitre Bitten');
$cat->makeANoise();
