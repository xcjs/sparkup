<?php

require_once('../vendor/autoload.php');

use \XCJS\Sparkup\ListElement;

class ListElementTest Extends PHPUnit_Framework_TestCase {

    public function testCreateUnorderedList()
    {
        $listEle = ListElement::createUnorderedList(array('Apple', 'Banana', 'Orange'));
        $expected = <<< OUT
<ul>
  <li>Apple</li>
  <li>Banana</li>
  <li>Orange</li>
</ul>
OUT;

        $this->assertEquals($expected, $listEle->save());
    }

    public function testCreateOrderedList()
    {
        $listEle = ListElement::createOrderedList(array('Apple', 'Banana', 'Orange'));
        $expected = <<< OUT
<ol>
  <li>Apple</li>
  <li>Banana</li>
  <li>Orange</li>
</ol>
OUT;

        $this->assertEquals($expected, $listEle->save());
    }

    public function testVerifyDataSource()
    {
        $this->markTestIncomplete();
    }
}
