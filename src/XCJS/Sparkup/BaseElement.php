<?php

namespace XCJS\Sparkup;

/**
 * 
 * @package Sparkup
 */
class BaseElement {

	// Member Variables -------------------------------------------------------/ 
	protected $tag = null;
	protected $xml = false;
	protected $void = false;

	protected $attributes = array();

	protected $children = array();

	protected $parent = null;

	// Public Members ---------------------------------------------------------/

	public function __construct() {
		$args = func_get_args();

		$text  = null;

		switch(count($args)) {
			// $this->tag
			case 1:
				$this->tag = $args[0];
				break;
			// $this->tag, $this->attributes or string converted to TextNode child
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
					throw new \Exception('The second constructor parameter must be either an array or string.');

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

		if($depth == 0)
			$output .= "\n";

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
		unset($this->attributes[$key]);

		// After calling unset on an array element, the key is left behind.
		// This resets the array to only hold keys with values.
		$this->attributes = array_values($this->attributes);
	}

	public function removeAllAttributes()
	{
		$this->attributes = array();
	}

	public function addChild($child) {
		if(is_object($child) && $child instanceof BaseElement) {
			$this->children[] = $child;
			$child->Parent($this);
		}
		else if(is_object($child) && $child instanceof TextNode) {
			$this->children[] = $child;
		}
		else
			throw new \Exception('Argument "$child" must be of type BaseElement or TextNode.');
	}

	public function removeChild($child) {
		$i = 0;
		$removal = false;

		if(is_int($child)) {
			unset($this->children[$child]);

			// After calling unset on an array element, the key is left behind.
			// This resets the array to only hold keys with values.
			$this->children = array_values($this->children);
			$removal = true;
		}
		else if(is_object($child) && ($child instanceof BaseElement || $child instanceof TextNode)) {
			while($i < count($this->children)) {
				
				if($this->children[$i] == $child) {
					unset($this->children[$i]);

					// After calling unset on an array element, the key is left behind.
					// This resets the array to only hold keys with values.
					$this->children = array_values($this->children);
					
					$removal = true;
					break;
				}

				$i++;
			}
		}
		else
			throw new \Exception('Argument "$child" must be of type BaseElement, TextNode, or int.');

		return $removal;
	}

	public function removeAllChildren() {
		$this->children = array();
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

	public function Tag($tag = null) {
		if(isset($tag)) {
			if(is_string($tag))
				$this->tag = $tag;
			else
				throw new \Exception('Property "Tag" must be of type string.');
		}
		else
			return $this->tag;
	}

	public function XmlSyntax($xml = null) {
		if(isset($xml))
		{
			if(is_bool($xml))
			{
				$this->xml = $xml;
			}
			else
				throw new \Exception('Property "XMLSyntax" must be of type bool.');
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
				throw new \Exception('Property "Void" must be of type bool.');
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

	public function Parent($parent = null) {
		if(isset($parent)) {
			if($parent instanceof BaseElement)
				$this->parent = $parent;
			else
				throw new \Exception('Property "Parent" must be of type BaseElement.');
		}
		else
			return $this->parent;
	}
}

?>