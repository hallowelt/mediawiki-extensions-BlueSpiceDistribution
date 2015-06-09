<?php

require_once( __DIR__."/includes/AutoLoader.php");
require_once( __DIR__."/BlueSpiceDistribution.hooks.php" );

$wgMessagesDirs['BlueSpiceDistribution'] = __DIR__ . '/i18n';

$wgResourceModules['ext.bluespice.distribution'] = array (
	'scripts' => 'extensions/BlueSpiceDistribution/BSDistConnector/resources/bluespice.distribution.js',
	'targets' => array ( 'mobile' ),
	'position' => 'bottom',
	'localBasePath' => $IP,
	'remoteBasePath' => &$GLOBALS['wgScriptPath']
);
