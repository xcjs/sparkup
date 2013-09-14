<?php
	require_once('../src/XCJS/Sparkup/TextNode.php');
	require_once('../src/XCJS/Sparkup/BaseElement.php');
	require_once('../src/XCJS/Sparkup/ListElement.php');

	use XCJS\Sparkup\TextNode as TextNode;
	use XCJS\Sparkup\BaseElement as BaseElement;
	use XCJS\Sparkup\ListElement as ListElement;

	$tn = new TextNode('I am a TextNode.');
	$p = new BaseElement('p', array('class' => 'pretty', 'id' => 'important'));
	$sp = new BaseElement('span');

	$sp->addChild($tn);
	$p->addChild($sp);

	echo $p->write();

	$p->removeChild($sp);

	echo $p->write();

	$sp->removeChild($tn);
	$p->addChild($sp);

	echo $p->write();

	$p->removeChild(0);
	$sp->addChild($tn);	
	$p->addChild($sp);

	echo $p->write();

	$l = new ListElement(array('Item 1', 'Item 2', 'Item 3'));
	echo $l->write();

	$l = new ListElement(array(new BaseElement('p', 'Element Item 1'), new BaseElement('p', 'Element Item 2'), new BaseElement('p', 'Element Item 3')));
	echo $l->write();

	$l->Ordered(true);
	echo $l->write();
?>