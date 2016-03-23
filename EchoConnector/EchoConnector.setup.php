<?php

$wgMessagesDirs['EchoConnector'] = __DIR__ . '/i18n';
$wgMessagesDirs['BSFoundation'] = __DIR__ . '/../../BlueSpiceFoundation/i18n';
$wgAutoloadClasses['EchoConnectorHooks'] = __DIR__."/includes/EchoConnectorHooks.php";
$wgAutoloadClasses['BSEchoNotificationHandler'] = __DIR__."/includes/EchoNotificationHandler.php";
$wgAutoloadClasses['BsNotificationsFormatter'] = __DIR__."/includes/NotificationsFormatter.php";
$wgAutoloadClasses['BsEchoEmailSingle'] = __DIR__."/includes/EchoEmailSingle.php";
$wgAutoloadClasses['BsEchoTextEmailFormatter'] = __DIR__."/includes/EchoTextEmailFormatter.php";
$wgAutoloadClasses['BsEchoTextEmailDecorator'] = __DIR__."/includes/EchoTextEmailDecorator.php";

$wgHooks['BeforeNotificationsInit'][] = "EchoConnectorHooks::onBeforeNotificationsInit";
$wgHooks['EchoGetDefaultNotifiedUsers'][] = "EchoConnectorHooks::onEchoGetDefaultNotifiedUsers";

$echoIconPath = "BlueSpiceDistribution/Echo/modules/icons";

// Defines icons, which are 30x30 images. This is passed to BeforeCreateEchoEvent so
// extensions can define their own icons with the same structure.  It is recommended that
// extensions prefix their icon key. An example is myextension-name.  This will help
// avoid namespace conflicts.
//
// You can use either a path or a url, but not both.
// The value of 'path' is relative to $wgExtensionAssetsPath.
//
// The value of 'url' should be a URL.
//
// You should customize the site icon URL, which is:
// $wgEchoNotificationIcons['site']['url']
$wgEchoNotificationIcons = array(
	'placeholder' => array(
		'path' => "$echoIconPath/Generic.png",
	),
	'trash' => array(
		'path' => "$echoIconPath/Deletion.png",
	),
	'chat' => array(
		'path' => "$echoIconPath/Talk.png",
	),
	'linked' => array(
		'path' => "$echoIconPath/CrossReferenced.png",
	),
	'featured' => array(
		'path' => "$echoIconPath/Featured.png",
	),
	'reviewed' => array(
		'path' => "$echoIconPath/Reviewed.png",
	),
	'tagged' => array(
		'path' => "$echoIconPath/ReviewedWithTags.png",
	),
	'revert' => array(
		'path' => "$echoIconPath/Revert.png",
	),
	'checkmark' => array(
		'path' => "$echoIconPath/Reviewed.png",
	),
	'gratitude' => array(
		'path' => "$echoIconPath/Gratitude.png",
	),
	'site' => array(
		'url' => false
	),
);

unset( $echoIconPath );

$echoRessourcePackages = array(
	'ext.echo.base', 'ext.echo.overlay', 'ext.echo.overlay.init',
	'ext.echo.special', 'ext.echo.alert', 'ext.echo.badge'
);

foreach( $echoRessourcePackages as $package ) {
	$wgResourceModules[$package]['remoteExtPath'] = 'BlueSpiceDistribution/Echo/modules';
}

unset( $echoRessourcePackages );
