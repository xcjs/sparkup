<?php
	require_once('../src/XCJS/Sparkup/TextNode.php');
	require_once('../src/XCJS/Sparkup/BaseElement.php');

	use XCJS\Sparkup\TextNode as TextNode;
	use XCJS\Sparkup\BaseElement as BaseElement;

	while(true) {
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

		unset($tn);
		unset($p);
		unset($sp);
	}
?>