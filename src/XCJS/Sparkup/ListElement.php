<?php

namespace XCJS\Sparkup;

class ListElement extends DomNodeExtensionsBase {

    const TAG_UNORDERED = 'ul';
    const TAG_ORDERED = 'ol';

    const TAG_LISTITEM = 'li';

    public function __construct($ordered = false)
    {
        if($ordered)
        {
            parent::__construct(ListElement::TAG_ORDERED);
        }
        else
        {
            parent::__construct(ListElement::TAG_UNORDERED);
        }
    }

    static function createUnorderedList($source)
    {
        $ordered = new ListElement();
        $ordered->setDataSource($source);
        $ordered->render();

        return $ordered;
    }

    static function createOrderedList($source)
    {
        $unordered = new ListElement(true);
        $unordered->setDataSource($source);
        $unordered->render();

        return $unordered;
    }

    public function render()
    {
        $dom = $this->getDom();
        $fragment = $this->getDom()->createDocumentFragment();

        $list = $fragment->appendChild($this);

        foreach($this->getDataSource() as $item)
        {
            $textNode = $dom->createTextNode($item);
            $listNode = $dom->createElement(ListElement::TAG_LISTITEM);

            $listNode->appendChild($textNode);
            $list->appendChild($listNode);
        }

        $this->getDom()->appendChild($fragment);
    }

    protected function verifyDataSource($source)
    {
        $valid = true;

        if(!is_array($source) || count($source) == 0)
        {
            $valid = false;
        }

        return $valid;
    }
}
