<?php

require_once('../vendor/autoload.php');
use XCJS\Sparkup\BaseElement as BaseElement;

class BaseElementTest Extends PHPUnit_Framework_TestCase {

	// Test Public Functions --------------------------------------------------/

	public function testAttributes() {
		// Expected result.
		$result = null;

		$Elem = new BaseElement('div');
		$Elem->setAttribute('class', 'test-div');

		$result = array('class' => 'test-div');

		$this->assertEquals($result, $Elem->Attributes());
	}

	/**
	 * @depends testAttributes
	 */
	public function testsetAttribute() {
		// Expected result.
		$result = null;

		$Elem = new BaseElement('div');
		$Elem->setAttribute('class', 'test-div');
		$result = 'class, test-div';
		foreach($Elem->Attributes() as $attr => $val) {
			$this->assertEquals($attr . ', ' . $val, $result);
		}

		$result = '<div class="test-div">' . "\n" . '</div>' . "\n";
		$this->assertEquals($Elem->write(), $result);

		$Elem->setAttribute('id', 'js-test-div');

		$result = str_replace('<div class="test-div">', '<div class="test-div" id="js-test-div">', $result);
		
		$this->assertEquals($result, $Elem->write());
	}

	/**
	 * @depends testsetAttribute
	 */
	public function testremoveAttribute() {
		// Expected result.
		$result = null;

		$Elem = new BaseElement('div');
		$Elem->setAttribute('class', 'test-div');
		$Elem->setAttribute('id', 'js-test-div');
		$Elem->removeAttribute('id');

		$result = '<div class="test-div">' . "\n" . '</div>' . "\n";

		$this->assertEquals($result, $Elem->write());
	}

	/**
	 * @depends testsetAttribute
	 */
	public function testremoveAllAttributes() {
		// Expected result.
		$result = null;

		$Elem = new BaseElement('div');
		$Elem->setAttribute('class', 'test-div');
		$Elem->setAttribute('id', 'js-test-div');
		$Elem->removeAllAttributes('id');

		$result = '<div>' . "\n" . '</div>' . "\n";

		$this->assertEquals($result, $Elem->write());
	}

	public function testaddChild() {
		$result = null;

		$Elem = new BaseElement('div');
		$Elem->addChild(new BaseElement('div'));

		$result = '<div>' . "\n\t" . '<div>' . "\n\t" . '</div>' . "\n" . '</div>' . "\n";

		$this->assertEquals($result, $Elem->write());
	}

	public function testremoveChild() {
		$result = null;

		$Elem = new BaseElement('div');
		$Child = new BaseElement('div');
		$Elem->addChild($Child);
		$Elem->removeChild(0);

		$result = '<div>' . "\n" . '</div>' . "\n";

		$this->assertEquals($result, $Elem->write());
	}

	public function removeAllChildren() {
		$Elem = new BaseElement('div');

		$this->markTestIncomplete('This test has not been implemented yet.');
	}

	// Test Private Functions -------------------------------------------------/

	public function testTab() {
		$Elem = new BaseElement('div');

		$this->markTestIncomplete('This test has not been implemented yet.');
	}

	// Test Properties --------------------------------------------------------/

	public function testTag() {
		$Elem = new BaseElement('div');

		$this->markTestIncomplete('This test has not been implemented yet.');
	}

	public function testXMLSyntax() {
		$Elem = new BaseElement('div');

		$this->markTestIncomplete('This test has not been implemented yet.');
	}

	public function testVoid() {
		$Elem = new BaseElement('div');

		$this->markTestIncomplete('This test has not been implemented yet.');
	}

	public function testAttribute() {
		$Elem = new BaseElement('div');

		$this->markTestIncomplete('This test has not been implemented yet.');
	}

	public function testParent() {
		$Elem = new BaseElement('div');

		$this->markTestIncomplete('This test has not been implemented yet.');
	}

	/**
	 * @depends testsetAttribute
	 */
	public function testwrite() {
		// Expected result.
		$result = null;

		$Elem = new BaseElement('div');
		$result = '<div>' . "\n" . '</div>' . "\n";
		$this->assertEquals($Elem->write(), $result);

		$Elem = new BaseElement('div', array('class' => 'test-div', 'id' => 'js-test-div'));
		$result = '<div class="test-div" id="js-test-div">' . "\n" . '</div>' . "\n";
		$this->assertEquals($Elem->write(), $result);
	}	
}

?>
