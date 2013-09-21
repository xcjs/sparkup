<?php

$oldCWD = getcwd();
chdir(__DIR__);

require_once('../vendor/autoload.php');

class BaseElementTest Extends PHPUnit_Framework_TestCase {

	// Test Public Functions --------------------------------------------------/

	public function testAttributes() {
		// Expected result.
		$result = null;

		$Elem = new XCJS\Sparkup\BaseElement('div');
		$Elem->setAttribute('class', 'test-div');
		$result = array('class' => 'test-div');
		$this->assertEquals($Elem->Attributes(), $result);
	}

	/**
	 * @depends testAttributes
	 */
	public function testsetAttribute() {
		// Expected result.
		$result = null;

		$Elem = new XCJS\Sparkup\BaseElement('div');
		$Elem->setAttribute('class', 'test-div');
		$result = 'class, test-div';
		foreach($Elem->Attributes() as $attr => $val) {
			$this->assertEquals($attr . ', ' . $val, $result);
		}

		$result = '<div class="test-div">' . "\n" . '</div>' . "\n";
		$this->assertEquals($Elem->write(), $result);

		$Elem->setAttribute('id', 'js-test-div');
		$result = str_replace('<div class="test-div">', '<div class="test-div" id="js-test-div">', $result);
		$this->assertEquals($Elem->write(), $result);
	}

	/**
	 * @depends testsetAttribute
	 */
	public function testremoveAttribute() {
		// Expected result;
		$result = null;

		$Elem = new XCJS\Sparkup\BaseElement('div');

		$this->markTestIncomplete('This test has not been implemented yet.');
	}

	public function testremoveAllAttributes() {
		$Elem = new XCJS\Sparkup\BaseElement('div');

		$this->markTestIncomplete('This test has not been implemented yet.');
	}

	public function testaddChild() {
		$Elem = new XCJS\Sparkup\BaseElement('div');

		$this->markTestIncomplete('This test has not been implemented yet.');
	}

	public function testremoveChild() {
		$Elem = new XCJS\Sparkup\BaseElement('div');

		$this->markTestIncomplete('This test has not been implemented yet.');
	}

	public function removeAllChildren() {
		$Elem = new XCJS\Sparkup\BaseElement('div');

		$this->markTestIncomplete('This test has not been implemented yet.');
	}

	// Test Private Functions -------------------------------------------------/

	public function testTab() {
		$Elem = new XCJS\Sparkup\BaseElement('div');

		$this->markTestIncomplete('This test has not been implemented yet.');
	}

	// Test Properties --------------------------------------------------------/

	public function testTag() {
		$Elem = new XCJS\Sparkup\BaseElement('div');

		$this->markTestIncomplete('This test has not been implemented yet.');
	}

	public function testXMLSyntax() {
		$Elem = new XCJS\Sparkup\BaseElement('div');

		$this->markTestIncomplete('This test has not been implemented yet.');
	}

	public function testVoid() {
		$Elem = new XCJS\Sparkup\BaseElement('div');

		$this->markTestIncomplete('This test has not been implemented yet.');
	}

	public function testAttribute() {
		$Elem = new XCJS\Sparkup\BaseElement('div');

		$this->markTestIncomplete('This test has not been implemented yet.');
	}

	public function testParent() {
		$Elem = new XCJS\Sparkup\BaseElement('div');

		$this->markTestIncomplete('This test has not been implemented yet.');
	}

	/**
	 * @depends testsetAttribute
	 */
	public function testwrite() {
		// Expected result.
		$result = null;

		$Elem = new XCJS\Sparkup\BaseElement('div');
		$result = '<div>' . "\n" . '</div>' . "\n";
		$this->assertEquals($Elem->write(), $result);

		$Elem = new XCJS\Sparkup\BaseElement('div', array('class' => 'test-div', 'id' => 'js-test-div'));
		$result = '<div class="test-div" id="js-test-div">' . "\n" . '</div>' . "\n";
		$this->assertEquals($Elem->write(), $result);
	}	
}

chdir($oldCWD);

?>