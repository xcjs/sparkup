<?php

require_once('../vendor/autoload.php');

use \XCJS\Sparkup\ListElement;

class ListElementTest Extends PHPUnit_Framework_TestCase {

    private $items = array('Apple', 'Banana', 'Orange');

    public function testCreateUnorderedList()
    {
        $listEle = ListElement::createUnorderedList($this->items);
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
        $listEle = ListElement::createOrderedList($this->items);
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
        $invalidDataSource = 'string';

        $listEle = new ListElement();

        $listEle->setDataSource($invalidDataSource);
        $this->assertEquals(null, $listEle->getDataSource());

        $listEle->setDataSource($this->items);
        $this->assertEquals($this->items, $listEle->getDataSource());
    }
}
