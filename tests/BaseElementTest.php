<?php

$oldCWD = getcwd();
chdir(__DIR__);

require_once('../vendor/autoload.php');

class BaseElementTest Extends PHPUnit_Framework_TestCase {

	public function testwrite()
	{
		
	}	
}

chdir($oldCWD);

?>