<?php

namespace XCJS\Sparkup;


class ListElement extends BaseElement {
	
	// Member Variables -------------------------------------------------------/
	private $ordered = false;
	private $items = array();

	public function __construct($items, $ordered = false) {		
		parent::__construct($ordered ? 'ol' : 'ul');
		$this->items = $items;
	}

	// Public Members ---------------------------------------------------------/

	public function write($recursive = true, $depth = 0) {
		$containerEle = null;

		foreach($this->items as $item) {
			if(is_string($item))
			{
				$this->addChild(new BaseElement('li', $item));
			}
			else if($item instanceof BaseElement || $item instanceof TextNode) {
				$containerEle = new BaseElement('li');
				$containerEle->addChild($item);

				$this->addChild($containerEle);
			}
			else
				throw new \Exception('List items must be of type BaseElement or string.');
		}

		return parent::write($recursive, $depth);
	}

	public function addItem($item) {
		if(is_string($item) || $item instanceof BaseElement)
			$this->items[] = $item
		else
			throw new \Exception('Parameter "$item" must be of type BaseElement or string.');
	}

	public function clearItems() {
		$this->items  = array();
	}

	// Properties -------------------------------------------------------------/

	public function Ordered($ordered = null) {
		if(isset($ordered))
		{
			if(is_bool($ordered))
				$this->ordered = $ordered;
			else
				throw new \Exception('Property "Ordered" must be of type boolean.');
		}
		else
			return $this->ordered;
	}
}

?>