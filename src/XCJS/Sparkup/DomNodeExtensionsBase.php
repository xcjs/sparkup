<?php

namespace XCJS\Sparkup;

class DomNodeExtensionsBase extends \DOMElement implements IDomNodeExtensions {

    private $dataSource = null;
    private $dom = null;

    public function __construct($tag)
    {
        parent::__construct($tag);
        $this->dom = new \DOMDocument();
        $this->dom->formatOutput = true;
    }

    public function getDataSource()
    {
        return $this->dataSource;
    }

    public function setDataSource($source)
    {
        if($this->verifyDataSource($source))
        {
            $this->dataSource = $source;
        }
    }

    public function getDom()
    {
        return $this->dom;
    }

    public function render()
    {

    }

    public function save()
    {
        return $this->dom->saveXml($this->dom->documentElement);
    }

    protected function verifyDataSource($source)
    {
        // Force superclasses to verify data.
        return false;
    }
}
