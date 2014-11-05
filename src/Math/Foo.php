<?php

class Foo {
	private $x;

	public function getX() {
		return $this->x;
	}

	public function setX( $x ) {
		$this->x = $x;
	}
}



final class Bar extends Foo {


}

class Baz extends Bar {

}