<?php

namespace XCJS\Sparkup;

class ListElement extends DomNodeExtensionsBase {


    public function __construct($ordered = false)
    {
        if($ordered)
        {
            parent::__construct('ol');
        }
        else
        {
            parent::__construct('ul');
        }
    }

    static function createUnorderedList($source)
    {
        $ordered = new ListElement();
        $ordered->setDataSource($source);
        $ordered->databind();

        return $ordered;
    }

    static function createOrderedList($source)
    {
        $unordered = new ListElement(true);
        $unordered->setDataSource($source);
        $unordered->databind();

        return $unordered;
    }

    public function databind()
    {
        $fragment = new \DOMDocument();
        $fragment->formatOutput = true;

        $root = $fragment->appendChild($fragment->importNode($this, true));

        foreach($this->getDataSource() as $item)
        {
            $textNode = $fragment->createTextNode($item);
            $child = $fragment->createElement('li');

            $child->appendChild($textNode);
            $root->appendChild($child);
        }

        $this->setDom($fragment);
    }

    protected function verifyDataSource($source)
    {
        if(!is_array($source) || count($source) == 0)
        {
            throw new \OutOfBoundsException("ListElement data sources must be an array with at least one element.");
        }

        return true;
    }
}
