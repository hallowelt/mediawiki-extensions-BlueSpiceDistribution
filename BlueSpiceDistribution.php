<?php

require_once( __DIR__."/CategoryTree/CategoryTree.php" );
require_once( __DIR__."/intersection/DynamicPageList.php" );
require_once( __DIR__."/Lockdown/Lockdown.php" );
require_once( __DIR__."/Quiz/Quiz.php" );
require_once( __DIR__."/RSS/RSS.php" );
require_once( __DIR__."/WikiCategoryTagCloud/WikiCategoryTagCloud.php" );
require_once( __DIR__."/Echo/Echo.php" );
require_once( __DIR__."/TitleKey/TitleKey.php" );
require_once( __DIR__."/NSFileRepo/NSFileRepo.php" );
require_once( __DIR__."/EmbedVideo/EmbedVideo.php" );
require_once( __DIR__."/ImageMapEdit/ImageMapEdit.php" );

if (version_compare( $wgVersion, '1.23', '>=' )){
	require_once( __DIR__ . "/MobileFrontend/MobileFrontend.php" );
	$wgMFAutodetectMobileView = true;
	$wgMFEnableDesktopResources = true;
}

require_once( __DIR__."/BSDistConnector/BSDistConnector.setup.php" );

//By default this is disabled. See https://gerrit.wikimedia.org/r/#/c/193359/1
//If this is needed depends on the actual LDAP setup
//$wgHooks['SetUsernameAttributeFromLDAP'][] = 'BlueSpiceDistributionHooks::onSetUsernameAttribute';