<?php

$oldCWD = getcwd();
chdir(__DIR__);

require_once('../vendor/autoload.php');

class ListElementTest Extends PHPUnit_Framework_TestCase {

	public function testwrite()
	{

	}

}

chdir($oldCWD);

?>