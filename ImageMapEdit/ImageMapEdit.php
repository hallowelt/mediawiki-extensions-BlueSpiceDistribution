<?php

/**
 * ImageMapEdit
 * Create image maps in the browser.
 * */
$wgExtensionCredits['parserhook'][] = [
	'path' => __FILE__,
	'name' => 'ImageMapEdit',
	'descriptionmsg' => 'imagemapedit-extension-description',
	'author' => ['Marc Reymann', 'Peter Schlömer', 'Tobias Weichart' ],
	'version' => '2.23.1',
];
if ( !defined( 'MEDIAWIKI' ) ) {
	exit;
}

$wgExtensionMessagesFiles['ImageMapEdit'] = __DIR__ . '/ImageMapEdit.i18n.php';

$wgAutoloadClasses['ImageMapEdit'] = __DIR__ . '/ImageMapEdit.class.php';

$wgHooks['OutputPageBeforeHTML'][] = 'ImageMapEdit::onOutputPageBeforeHTML';
$wgHooks['BeforePageDisplay'][] = 'ImageMapEdit::onBeforePageDisplay';