<?php

namespace XCJS\Sparkup;

class BaseElement {

	// Member Variables -------------------------------------------------------/ 
	private $tag = null;
	private $xml = false;
	private $void = false;

	private $attributes = array();

	private $children = array();


	// Public Members ---------------------------------------------------------/

	public function __construct() {
		$args = func_get_args();

		$text  = null;

		switch(count($args)) {
			// $this->tag
			case 1:
				$this->tag = $args[0];
				break;
			// $this->tag, $this->attributes or $this->textNode
			case 2:
				$this->tag = $args[0];

				if(is_array($args[1])) {
					$this->attributes = $args[1];
				}
				elseif(is_string($args[1])) {
					$text = new TextNode($args[1]);
					$this->addChild($text);
				}
				else
					throw new Exception('The second constructor parameter must be either an array or string.');

				break;
		}
	}

	public function write($recursive = true, $depth = 0) {
		$output = $this->tab($depth);

		$output .= '<' . $this->tag;

		if(count($this->attributes) > 0)
		{
			foreach($this->attributes as $attribute => $value)
			{
				$output .= ' ' . $attribute . '="' . $value . '"';
			}
		}

		if($this->void)
		{
			if($this->xml)
			{
				$output .= ' />';
			}
			else
			{
				$output .= '>';
			}
		}
		else
		{
			$output .= '>';

			if($recursive && count($this->children) > 0)
			{
				$depth += 1;

				foreach($this->children as $child)
				{
					if($child instanceof TextNode)
						$output .= "\n" . $this->tab($depth) . $child->write();
					else
						$output .= "\n" . $child->write(true, $depth);
				}

				$depth -= 1;
			}

			$output .= "\n" . $this->tab($depth) . '</' . $this->tag . '>';
		}

		return $output;
	}

	public function setAttribute($key, $value)
	{
		if(is_string($key) && is_string($value))
		{
			$this->attributes[$key] = $value;
		}
		else
			throw new \Exception('Arguments "$key" and "$value" must be of type string.');
	}

	public function removeAttribute($key)
	{

	}

	public function removeAllAttributes()
	{
		$this->attributes = array();
	}

	public function addChild($child) {
		if(is_object($child) && ($child instanceof BaseElement || $child instanceof TextNode))
			$this->children[] = $child;
		else
			throw new Exception('Argument "$child" must be of type BaseElement.');
	}

	public function removeChild($child) {
		if(is_int($child)) {

		}
		else if(is_object($child) && $child instanceof BaseElement) {

		}
	}

	// Private Members --------------------------------------------------------/

	protected function tab($num) {
		$i = 0;
		$tabs = "";

		while($i < $num) {
			$tabs .= "\t";
			$i++;
		}

		return $tabs;
	}

	// Properties -------------------------------------------------------------/

	public function XmlSyntax($xml = null) {
		if(isset($xml))
		{
			if(is_bool($xml))
			{
				$this->xml = $xml;
			}
			else
				throw new Exception('Property "XMLSyntax" must be of type bool.');
		}
		else
			return $this->xml;
	}

	public function Void($void = null) {
		if(isset($void))
		{
			if(is_bool($void))
			{
				$this->void = $void;
			}
			else
				throw new Exception('Property "Void" must be of type bool.');
		}
		else
			return $this->void;
	}

	public function Attributes() {
		return $this->attributes;
	}

	public function Attribute($key)	{
		return $this->attributes[$key];
	}
}

?>