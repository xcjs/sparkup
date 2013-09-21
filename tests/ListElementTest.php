<?php

$oldCWD = getcwd();
chdir(__DIR__);

require_once('../vendor/autoload.php');

class ListElementTest Extends PHPUnit_Framework_TestCase {

	public function testwrite()
	{
		$this->markTestIncomplete('This test has not been implemented yet.');
	}

}

chdir($oldCWD);

?>