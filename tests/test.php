<?php
	require_once('../src/XCJS/Sparkup/TextNode.php');
	require_once('../src/XCJS/Sparkup/BaseElement.php');

	use XCJS\Sparkup\TextNode as TextNode;
	use XCJS\Sparkup\BaseElement as BaseElement;

	$node = new TextNode('<p>I am a paragraph in HTML.</p>');
	echo $node->writeLine();

	$node->WriteMode('raw');
	echo $node->writeLine();

	$node->WriteMode('stripped');
	echo $node->writeLine();

	try {
		$node->WriteMode('not valid');
	}
	catch(\Exception $ex) {
		echo $ex->getMessage() . "\n";
	}

	$node = new BaseElement('p', 'I am a paragraph in HTML.');
	$node->addChild(new BaseElement('span', 'I am a span inside a paragraph.'));
	echo $node->write();

?>